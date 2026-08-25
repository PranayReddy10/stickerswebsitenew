<?php

namespace AppBundle\Service;

/**
 * Minimal DigitalOcean Spaces client.
 *
 * Spaces speaks the S3 API, so this signs requests with AWS Signature V4. It is
 * written by hand rather than pulling in aws/aws-sdk-php on purpose: this project
 * is Symfony 2.8 with a php ">=5.3.9" constraint, and running composer against
 * that tree to add a large SDK is a much bigger risk than ~80 lines of HMAC.
 *
 * Only two things are needed here: hand the app a short lived URL it can PUT a
 * file to, and turn an object key back into a public URL.
 */
class SpacesClient
{
    const ALGORITHM = 'AWS4-HMAC-SHA256';
    const SERVICE = 's3';
    /** Presigned PUT URLs are valid for 15 minutes, enough for a slow mobile upload. */
    const EXPIRES = 900;

    private $key;
    private $secret;
    private $region;
    private $bucket;
    private $endpoint;
    private $cdn;

    public function __construct($key, $secret, $region, $bucket, $endpoint, $cdn)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->bucket = $bucket;
        $this->endpoint = rtrim($endpoint, '/');
        $this->cdn = rtrim($cdn, '/');
        // The region has to match the host the request actually goes to, or Spaces
        // answers 403 SignatureDoesNotMatch. For DigitalOcean the endpoint already
        // names the region, so trust that over a possibly stale configured value.
        $this->region = self::regionFromEndpoint($this->endpoint, $region);
    }

    /**
     * DigitalOcean endpoints are <region>.digitaloceanspaces.com. Anything else is
     * left alone, so a non-DO S3 endpoint still uses the configured region.
     */
    private static function regionFromEndpoint($endpoint, $fallback)
    {
        $host = preg_replace('#^https?://#', '', $endpoint);
        if (preg_match('#^([a-z0-9-]+)\\.digitaloceanspaces\\.com$#i', $host, $m)) {
            return strtolower($m[1]);
        }
        return $fallback;
    }

    /** The region actually being signed with, after resolving it from the endpoint. */
    public function getRegion()
    {
        return $this->region;
    }

    /** The bucket host requests go to, for showing in the panel. */
    public function getHost()
    {
        return $this->host();
    }

    public function getBucket()
    {
        return $this->bucket;
    }

    /** False when Spaces has not been configured yet, so callers can fail cleanly. */
    public function isConfigured()
    {
        return $this->key !== null && $this->key !== ''
            && $this->secret !== null && $this->secret !== ''
            && $this->bucket !== null && $this->bucket !== '';
    }

    /**
     * Builds an object key for a new upload. The date prefix keeps the bucket
     * browsable, and the random name means two users uploading at the same moment
     * can never collide or guess each other's keys.
     */
    public function buildKey($prefix, $extension)
    {
        $extension = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $extension));
        if ($extension === '') {
            $extension = 'bin';
        }
        return sprintf('%s/%s/%s.%s',
            trim($prefix, '/'),
            gmdate('Y/m'),
            bin2hex(self::randomBytes(16)),
            $extension);
    }

    /**
     * A URL the client can PUT the file to, plus the exact headers it has to send.
     *
     * The headers are signed, so they are not advisory: sending a different
     * Content-Type or leaving out the ACL makes Spaces reject the upload. They are
     * returned to the caller so the app never has to guess.
     *
     * @return array{url: string, headers: array, public_url: string}
     */
    public function presignPut($objectKey, $contentType)
    {
        $headers = array(
            'host' => $this->host(),
            'content-type' => $contentType,
            'x-amz-acl' => 'public-read',
        );
        ksort($headers);

        $now = $this->now();
        $amzDate = gmdate('Ymd\THis\Z', $now);
        $dateStamp = gmdate('Ymd', $now);
        $credentialScope = $dateStamp . '/' . $this->region . '/' . self::SERVICE . '/aws4_request';
        $signedHeaders = implode(';', array_keys($headers));

        $query = array(
            'X-Amz-Algorithm' => self::ALGORITHM,
            'X-Amz-Credential' => $this->key . '/' . $credentialScope,
            'X-Amz-Date' => $amzDate,
            'X-Amz-Expires' => (string) self::EXPIRES,
            'X-Amz-SignedHeaders' => $signedHeaders,
        );
        ksort($query);

        $canonicalQuery = array();
        foreach ($query as $name => $value) {
            $canonicalQuery[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
        $canonicalQuery = implode('&', $canonicalQuery);

        $canonicalHeaders = '';
        foreach ($headers as $name => $value) {
            $canonicalHeaders .= $name . ':' . trim($value) . "\n";
        }

        $canonicalRequest = "PUT\n"
            . $this->canonicalUri($objectKey) . "\n"
            . $canonicalQuery . "\n"
            . $canonicalHeaders . "\n"
            . $signedHeaders . "\n"
            . 'UNSIGNED-PAYLOAD';

        $stringToSign = self::ALGORITHM . "\n"
            . $amzDate . "\n"
            . $credentialScope . "\n"
            . hash('sha256', $canonicalRequest);

        $signature = bin2hex($this->sign($this->signingKey($dateStamp), $stringToSign));

        $url = $this->baseUrl() . $this->canonicalUri($objectKey)
            . '?' . $canonicalQuery . '&X-Amz-Signature=' . $signature;

        unset($headers['host']); // the HTTP client sets Host itself
        return array(
            'url' => $url,
            'object_key' => $objectKey,
            'headers' => $headers,
            'public_url' => $this->publicUrl($objectKey),
        );
    }

    /**
     * Uploads a local file to Spaces from the server.
     *
     * This is the escape hatch for the admin page: a browser PUT needs a CORS rule
     * on the bucket, but a server-to-server PUT does not, because CORS is a browser
     * rule and nothing else. The trade-off is that the bytes cross PHP, so
     * upload_max_filesize and post_max_size apply again - fine for the panel, which
     * is why the app still uses the direct presigned path.
     *
     * @return true on success, or a string describing the failure.
     */
    public function putFile($objectKey, $contentType, $filePath)
    {
        if (!is_readable($filePath)) {
            return 'Temporary file is not readable.';
        }
        $signed = $this->presignPut($objectKey, $contentType);

        $headers = array();
        foreach ($signed['headers'] as $name => $value) {
            $headers[] = $name . ': ' . $value;
        }

        if (!function_exists('curl_init')) {
            return 'PHP has no cURL extension, so the server cannot upload for you. '
                . 'Add the CORS rule to the Space instead.';
        }

        $handle = fopen($filePath, 'rb');
        if ($handle === false) {
            return 'Could not open the uploaded file.';
        }

        $curl = curl_init($signed['url']);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_INFILE, $handle);
        curl_setopt($curl, CURLOPT_INFILESIZE, filesize($filePath));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        $body = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);
        fclose($handle);

        if ($error !== '') {
            return 'Could not reach Spaces from the server: ' . $error;
        }
        if ($status < 200 || $status >= 300) {
            return 'Spaces refused the upload (HTTP ' . $status . '). ' . substr((string) $body, 0, 300);
        }
        return true;
    }

    /**
     * Public URL for an object. Uses the CDN hostname when one is configured,
     * otherwise the plain Spaces origin.
     */
    public function publicUrl($objectKey)
    {
        if ($objectKey === null || $objectKey === '') {
            return '';
        }
        $base = $this->cdn !== '' ? $this->cdn : $this->baseUrl();
        return $base . $this->canonicalUri($objectKey);
    }

    /** Overridable so a test can pin the clock and reproduce a signature. */
    protected function now()
    {
        return time();
    }

    private function baseUrl()
    {
        return 'https://' . $this->host();
    }

    private function host()
    {
        // Virtual hosted style: <bucket>.<region>.digitaloceanspaces.com
        $host = preg_replace('#^https?://#', '', $this->endpoint);
        return $this->bucket . '.' . $host;
    }

    /** Each path segment is encoded, but the separators stay as separators. */
    private function canonicalUri($objectKey)
    {
        $segments = explode('/', ltrim($objectKey, '/'));
        foreach ($segments as $i => $segment) {
            $segments[$i] = rawurlencode($segment);
        }
        return '/' . implode('/', $segments);
    }

    private function signingKey($dateStamp)
    {
        $kDate = $this->sign('AWS4' . $this->secret, $dateStamp);
        $kRegion = $this->sign($kDate, $this->region);
        $kService = $this->sign($kRegion, self::SERVICE);
        return $this->sign($kService, 'aws4_request');
    }

    private function sign($key, $data)
    {
        return hash_hmac('sha256', $data, $key, true);
    }

    private static function randomBytes($length)
    {
        if (function_exists('random_bytes')) {
            return random_bytes($length);
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return openssl_random_pseudo_bytes($length);
        }
        $bytes = '';
        for ($i = 0; $i < $length; $i++) {
            $bytes .= chr(mt_rand(0, 255));
        }
        return $bytes;
    }
}
