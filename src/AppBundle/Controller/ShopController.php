<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * The shop's products, fetched by this server rather than by the app.
 *
 * <p>The shop's API key stays here. An app that called the shop directly would have
 * to carry the key, and a key inside an APK is a key anybody can read out of the
 * file - so the app asks this server, and this server asks the shop. The app never
 * sees it, and the key can be changed without shipping a build.
 *
 * <p>The answer is cached for a few minutes. A product list does not change by the
 * second, and a hundred phones opening the app at once should not be a hundred
 * requests to somebody else's shop.
 */
class ShopController extends Controller
{
    /** How long a fetched page of products stays good for. */
    const CACHE_SECONDS = 300;

    /** Nothing waits on the shop for longer than this. */
    const TIMEOUT_SECONDS = 15;

    /**
     * Products, for the app.
     *
     * <p>Whatever the shop answers is passed through unchanged, so the app maps the
     * shop's own fields and nothing has to be kept in step here.
     */
    public function api_productsAction(Request $request, $token)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");
        }

        $setting = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Settings')->findOneBy(array());
        if ($setting === null || !$setting->isShopEnabled()) {
            return new JsonResponse(array('code' => 503, 'message' => 'The shop is off.'));
        }

        // Only the parameters the shop understands, and nothing a caller invents:
        // this endpoint must not become a way to aim this server at other URLs.
        $query = array();
        foreach (array('page', 'per_page', 'category', 'q', 'search', 'sku') as $name) {
            $value = trim((string) $request->query->get($name));
            if ($value !== '') {
                $query[$name] = $value;
            }
        }
        if (!isset($query['per_page'])) {
            $query['per_page'] = 20;
        }
        $query['per_page'] = min(50, max(1, (int) $query['per_page']));

        $answer = $this->fetch($setting, $setting->getShopEndpoint(), $query);
        if ($answer['ok']) {
            // The shop's own JSON, byte for byte. JsonResponse::setJson does not exist
            // in this Symfony, and re-encoding a decoded body would quietly change
            // numbers and empty arrays on the way through.
            return new Response($answer['body'], 200,
                array('Content-Type' => 'application/json; charset=UTF-8'));
        }

        return new JsonResponse(array('code' => 502, 'message' => $answer['message']));
    }

    /**
     * The shop's categories, for the filter row above the products.
     *
     * <p>Same passthrough and same cache as the products; only the address differs.
     * A shop whose API has no categories simply leaves the row empty, which the app
     * copes with, so this never becomes a reason the product list will not open.
     */
    public function api_categoriesAction(Request $request, $token)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");
        }

        $setting = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Settings')->findOneBy(array());
        if ($setting === null || !$setting->isShopEnabled()) {
            return new JsonResponse(array('code' => 503, 'message' => 'The shop is off.'));
        }

        $answer = $this->fetch($setting, $this->categoriesEndpoint($setting), array());
        if ($answer['ok']) {
            return new Response($answer['body'], 200,
                array('Content-Type' => 'application/json; charset=UTF-8'));
        }

        return new JsonResponse(array('code' => 502, 'message' => $answer['message']));
    }

    /**
     * Where the categories live, worked out from the products address.
     *
     * <p>Only ever a sibling of the configured endpoint - this must not become a way
     * to point this server at an address somebody passed in.
     */
    private function categoriesEndpoint($setting)
    {
        $endpoint = $setting->getShopEndpoint();
        $categories = preg_replace('#/products/*$#', '/categories', $endpoint);

        return $categories === $endpoint ? '' : $categories;
    }

    /**
     * Asks the shop, through the cache.
     *
     * @return array ok, body (raw JSON) or message
     */
    private function fetch($setting, $endpoint, array $query)
    {
        if ($endpoint === '' || !filter_var($endpoint, FILTER_VALIDATE_URL)) {
            return array('ok' => false, 'message' => 'The shop has no address configured.');
        }

        $cacheFile = $this->cachePath($endpoint, $query);
        if ($cacheFile !== null && is_readable($cacheFile)
                && (time() - filemtime($cacheFile)) < self::CACHE_SECONDS) {
            return array('ok' => true, 'body' => file_get_contents($cacheFile));
        }

        $url = $endpoint . (strpos($endpoint, '?') === false ? '?' : '&') . http_build_query($query);

        if (!function_exists('curl_init')) {
            return array('ok' => false, 'message' => 'This server has no cURL extension.');
        }

        $headers = array('Accept: application/json');
        if ($setting->hasShopKey()) {
            // The header rather than ?key=, so the key stays out of the shop's own
            // access log and out of anything that records URLs.
            $headers[] = 'X-Api-Key: ' . trim($setting->getShopapikey());
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($curl, CURLOPT_TIMEOUT, self::TIMEOUT_SECONDS);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $body = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($body === false) {
            return array('ok' => false, 'message' => 'Could not reach the shop: ' . $error);
        }
        if ($status === 401 || $status === 403) {
            return array('ok' => false,
                'message' => 'The shop refused the API key (HTTP ' . $status . ').');
        }
        if ($status < 200 || $status >= 300) {
            return array('ok' => false, 'message' => 'The shop answered HTTP ' . $status . '.');
        }
        if (json_decode($body) === null) {
            return array('ok' => false, 'message' => 'The shop did not answer with JSON.');
        }

        if ($cacheFile !== null) {
            @file_put_contents($cacheFile, $body);
        }

        return array('ok' => true, 'body' => $body);
    }

    /** One file per distinct question asked of the shop. */
    private function cachePath($endpoint, array $query)
    {
        $directory = $this->container->getParameter('kernel.cache_dir') . '/shop';
        if (!is_dir($directory) && !@mkdir($directory, 0775, true)) {
            return null;
        }

        return $directory . '/' . sha1($endpoint . '?' . http_build_query($query)) . '.json';
    }

    // ============================================================ admin panel

    /**
     * Asks the shop once and says exactly what came back.
     *
     * <p>Turns "the shop button does nothing" into an answer: whether the address is
     * right, whether the key is accepted, and how many products are on the other end.
     */
    public function admin_checkAction(Request $request)
    {
        $setting = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Settings')->findOneBy(array());
        if ($setting === null) {
            return new JsonResponse(array('code' => 404, 'message' => 'No settings row yet.'));
        }

        // Straight to the shop, past the cache: this is a question about right now.
        $answer = $this->fetch($setting, $setting->getShopEndpoint(),
            array('per_page' => 1, '_t' => time()));
        if (!$answer['ok']) {
            return new JsonResponse(array('code' => 502, 'message' => $answer['message']));
        }

        $parsed = json_decode($answer['body'], true);
        $products = isset($parsed['data']) && is_array($parsed['data']) ? $parsed['data'] : array();
        $total = isset($parsed['meta']['total']) ? (int) $parsed['meta']['total'] : count($products);
        $first = isset($products[0]['name']) ? $products[0]['name'] : null;

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'The shop answered. ' . $total . ' product'
                . ($total == 1 ? '' : 's') . ' available'
                . ($first === null ? '.' : ', starting with "' . $first . '".'),
            'key' => $setting->hasShopKey() ? 'sent' : 'not set',
        ));
    }
}
