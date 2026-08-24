<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/api/user')) {
            // api_user_get_followingstop
            if (0 === strpos($pathinfo, '/api/user/followingstop') && preg_match('#^/api/user/followingstop/(?P<user>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_get_followingstop');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_get_followingstop')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_followingstopAction',));
            }

            // api_user_register
            if (0 === strpos($pathinfo, '/api/user/register') && preg_match('#^/api/user/register/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_user_register;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_register')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_registerAction',));
            }
            not_api_user_register:

            // api_user_edit
            if (0 === strpos($pathinfo, '/api/user/edit') && preg_match('#^/api/user/edit/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_user_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_edit')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_editAction',));
            }
            not_api_user_edit:

            // api_user_token
            if (0 === strpos($pathinfo, '/api/user/token') && preg_match('#^/api/user/token/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_user_token;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_token')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_tokenAction',));
            }
            not_api_user_token:

            // api_user_login
            if (0 === strpos($pathinfo, '/api/user/login') && preg_match('#^/api/user/login/(?P<username>[^/]++)/(?P<password>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_user_login;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_login');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_login')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_loginAction',));
            }
            not_api_user_login:

        }

        if (0 === strpos($pathinfo, '/users')) {
            // user_user_index
            if ($pathinfo === '/users/index.html') {
                return array (  '_controller' => 'UserBundle\\Controller\\UserController::indexAction',  '_route' => 'user_user_index',);
            }

            // user_user_edit
            if (0 === strpos($pathinfo, '/users/edit') && preg_match('#^/users/edit/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_edit')), array (  '_controller' => 'UserBundle\\Controller\\UserController::editAction',));
            }

            if (0 === strpos($pathinfo, '/users/follow')) {
                // user_user_followers
                if (0 === strpos($pathinfo, '/users/followers') && preg_match('#^/users/followers/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_followers')), array (  '_controller' => 'UserBundle\\Controller\\UserController::followersAction',));
                }

                // user_user_followings
                if (0 === strpos($pathinfo, '/users/followings') && preg_match('#^/users/followings/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_followings')), array (  '_controller' => 'UserBundle\\Controller\\UserController::followingsAction',));
                }

            }

            // user_user_comments
            if (0 === strpos($pathinfo, '/users/comments') && preg_match('#^/users/comments/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_comments')), array (  '_controller' => 'UserBundle\\Controller\\UserController::commentsAction',));
            }

            // user_user_ratings
            if (0 === strpos($pathinfo, '/users/ratings') && preg_match('#^/users/ratings/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_ratings')), array (  '_controller' => 'UserBundle\\Controller\\UserController::ratingsAction',));
            }

            // user_user_packs
            if (0 === strpos($pathinfo, '/users/packs') && preg_match('#^/users/packs/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_packs')), array (  '_controller' => 'UserBundle\\Controller\\UserController::packsAction',));
            }

            // user_user_view
            if (0 === strpos($pathinfo, '/users/view') && preg_match('#^/users/view/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_user_view')), array (  '_controller' => 'UserBundle\\Controller\\UserController::viewAction',));
            }

        }

        if (0 === strpos($pathinfo, '/api/user')) {
            // api_user_change_password
            if (0 === strpos($pathinfo, '/api/user/password') && preg_match('#^/api/user/password/(?P<id>[^/]++)/(?P<password>[^/]++)/(?P<new_password>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_user_change_password;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_change_password');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_change_password')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_change_passwordAction',));
            }
            not_api_user_change_password:

            // api_user_edit_name
            if (0 === strpos($pathinfo, '/api/user/name') && preg_match('#^/api/user/name/(?P<id>[^/]++)/(?P<name>[^/]++)/(?P<key>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_user_edit_name;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_edit_name');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_edit_name')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_edit_nameAction',));
            }
            not_api_user_edit_name:

            // api_user_email
            if (0 === strpos($pathinfo, '/api/user/email') && preg_match('#^/api/user/email/(?P<email>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_user_email;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_email');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_email')), array (  '_controller' => 'UserBundle\\Controller\\ResettingController::api_emailAction',));
            }
            not_api_user_email:

            if (0 === strpos($pathinfo, '/api/user/re')) {
                // api_user_request
                if (0 === strpos($pathinfo, '/api/user/request') && preg_match('#^/api/user/request/(?P<key>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_user_request;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_request');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_request')), array (  '_controller' => 'UserBundle\\Controller\\ResettingController::api_requestAction',));
                }
                not_api_user_request:

                // api_user_reset
                if (0 === strpos($pathinfo, '/api/user/reset') && preg_match('#^/api/user/reset/(?P<id>[^/]++)/(?P<key>[^/]++)/(?P<new_password>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_user_reset;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_reset');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_reset')), array (  '_controller' => 'UserBundle\\Controller\\ResettingController::api_resetAction',));
                }
                not_api_user_reset:

            }

            // api_user_check
            if (0 === strpos($pathinfo, '/api/user/check') && preg_match('#^/api/user/check/(?P<id>[^/]++)/(?P<key>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_user_check;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_check');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_check')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_checkAction',));
            }
            not_api_user_check:

            // api_user_upload
            if (0 === strpos($pathinfo, '/api/user/upload') && preg_match('#^/api/user/upload/(?P<id>[^/]++)/(?P<key>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_upload');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_upload')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_uploadAction',));
            }

            // api_user_get
            if (0 === strpos($pathinfo, '/api/user/get') && preg_match('#^/api/user/get/(?P<user>[^/]++)/(?P<me>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_user_get');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_get')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_getAction',));
            }

            if (0 === strpos($pathinfo, '/api/user/follow')) {
                // api_user_follow
                if (preg_match('#^/api/user/follow/(?P<user>[^/]++)/(?P<follower>[^/]++)/(?P<key_>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_follow');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_follow')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_followAction',));
                }

                // api_user_follow_check
                if (0 === strpos($pathinfo, '/api/user/follow/check') && preg_match('#^/api/user/follow/check/(?P<user>[^/]++)/(?P<follower>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_follow_check');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_follow_check')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_follow_checkAction',));
                }

                // api_user_get_followers
                if (0 === strpos($pathinfo, '/api/user/followers') && preg_match('#^/api/user/followers/(?P<user>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_get_followers');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_get_followers')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_followersAction',));
                }

                // api_user_get_followings
                if (0 === strpos($pathinfo, '/api/user/followings') && preg_match('#^/api/user/followings/(?P<user>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_user_get_followings');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_user_get_followings')), array (  '_controller' => 'UserBundle\\Controller\\UserController::api_followingsAction',));
                }

            }

        }

        // app_home_index
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'app_home_index');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\HomeController::indexAction',  '_route' => 'app_home_index',);
        }

        // app_home_ads
        if ($pathinfo === '/ads.html') {
            return array (  '_controller' => 'AppBundle\\Controller\\HomeController::adsAction',  '_route' => 'app_home_ads',);
        }

        // app_home_settings
        if ($pathinfo === '/settings.html') {
            return array (  '_controller' => 'AppBundle\\Controller\\HomeController::settingsAction',  '_route' => 'app_home_settings',);
        }

        if (0 === strpos($pathinfo, '/tags')) {
            // app_home_tags
            if ($pathinfo === '/tags.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\HomeController::tagsAction',  '_route' => 'app_home_tags',);
            }

            // app_home_tags_delete
            if (0 === strpos($pathinfo, '/tags/delete') && preg_match('#^/tags/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_home_tags_delete')), array (  '_controller' => 'AppBundle\\Controller\\HomeController::deletetagAction',));
            }

        }

        // app_home_privacypolicy
        if ($pathinfo === '/privacy_policy.html') {
            return array (  '_controller' => 'AppBundle\\Controller\\HomeController::privacypolicyAction',  '_route' => 'app_home_privacypolicy',);
        }

        if (0 === strpos($pathinfo, '/notif')) {
            // app_home_notif_pack
            if ($pathinfo === '/notif/pack.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\HomeController::notifPackAction',  '_route' => 'app_home_notif_pack',);
            }

            if (0 === strpos($pathinfo, '/notif/u')) {
                // app_home_notif_url
                if ($pathinfo === '/notif/url.html') {
                    return array (  '_controller' => 'AppBundle\\Controller\\HomeController::notifUrlAction',  '_route' => 'app_home_notif_url',);
                }

                if (0 === strpos($pathinfo, '/notif/user')) {
                    // app_home_notif_user_pack
                    if ($pathinfo === '/notif/user_pack.html') {
                        return array (  '_controller' => 'AppBundle\\Controller\\HomeController::notifUserpackAction',  '_route' => 'app_home_notif_user_pack',);
                    }

                    // app_home_notif_user
                    if ($pathinfo === '/notif/user.html') {
                        return array (  '_controller' => 'AppBundle\\Controller\\HomeController::notifUserAction',  '_route' => 'app_home_notif_user',);
                    }

                }

            }

            // app_home_notif_category
            if ($pathinfo === '/notif/category.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\HomeController::notifCategoryAction',  '_route' => 'app_home_notif_category',);
            }

        }

        // api_home_api_device
        if (0 === strpos($pathinfo, '/api/device') && preg_match('#^/api/device/(?P<tkn>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'api_home_api_device');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_home_api_device')), array (  '_controller' => 'AppBundle\\Controller\\HomeController::api_deviceAction',));
        }

        if (0 === strpos($pathinfo, '/support')) {
            // app_support_index
            if ($pathinfo === '/support/index.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\SupportController::indexAction',  '_route' => 'app_support_index',);
            }

            // app_support_view
            if (0 === strpos($pathinfo, '/support/view') && preg_match('#^/support/view/(?P<id>[^/\\.]++)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_support_view')), array (  '_controller' => 'AppBundle\\Controller\\SupportController::viewAction',));
            }

            // app_support_delete
            if (0 === strpos($pathinfo, '/support/delete') && preg_match('#^/support/delete/(?P<id>[^/\\.]++)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_support_delete')), array (  '_controller' => 'AppBundle\\Controller\\SupportController::deleteAction',));
            }

        }

        // api_support_add
        if (0 === strpos($pathinfo, '/api/support/add') && preg_match('#^/api/support/add/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_api_support_add;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_support_add')), array (  '_controller' => 'AppBundle\\Controller\\SupportController::api_addAction',));
        }
        not_api_support_add:

        if (0 === strpos($pathinfo, '/slide')) {
            // app_slide_add
            if ($pathinfo === '/slide/add.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\SlideController::addAction',  '_route' => 'app_slide_add',);
            }

            // app_slide_index
            if ($pathinfo === '/slide/index.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\SlideController::indexAction',  '_route' => 'app_slide_index',);
            }

            // app_slide_edit
            if (preg_match('#^/slide/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_slide_edit')), array (  '_controller' => 'AppBundle\\Controller\\SlideController::editAction',));
            }

            // app_slide_delete
            if (0 === strpos($pathinfo, '/slide/delete') && preg_match('#^/slide/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_slide_delete')), array (  '_controller' => 'AppBundle\\Controller\\SlideController::deleteAction',));
            }

            // app_slide_up
            if (0 === strpos($pathinfo, '/slide/up') && preg_match('#^/slide/up/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_slide_up')), array (  '_controller' => 'AppBundle\\Controller\\SlideController::upAction',));
            }

            // app_slide_down
            if (0 === strpos($pathinfo, '/slide/down') && preg_match('#^/slide/down/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_slide_down')), array (  '_controller' => 'AppBundle\\Controller\\SlideController::downAction',));
            }

        }

        // api_slide_all
        if (0 === strpos($pathinfo, '/api/slide/all') && preg_match('#^/api/slide/all/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'api_slide_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_slide_all')), array (  '_controller' => 'AppBundle\\Controller\\SlideController::api_allAction',));
        }

        if (0 === strpos($pathinfo, '/category')) {
            // app_category_index
            if ($pathinfo === '/category/index.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\CategoryController::indexAction',  '_route' => 'app_category_index',);
            }

            // app_category_add
            if ($pathinfo === '/category/add.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\CategoryController::addAction',  '_route' => 'app_category_add',);
            }

            // app_category_edit
            if (0 === strpos($pathinfo, '/category/edit') && preg_match('#^/category/edit/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_category_edit')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::editAction',));
            }

            // app_category_delete
            if (0 === strpos($pathinfo, '/category/delete') && preg_match('#^/category/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_category_delete')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::deleteAction',));
            }

            // app_category_up
            if (0 === strpos($pathinfo, '/category/up') && preg_match('#^/category/up/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_category_up')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::upAction',));
            }

            // app_category_down
            if (0 === strpos($pathinfo, '/category/down') && preg_match('#^/category/down/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_category_down')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::downAction',));
            }

        }

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/category')) {
                // api_category_all
                if (0 === strpos($pathinfo, '/api/category/all') && preg_match('#^/api/category/all/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_category_all');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_category_all')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::api_allAction',));
                }

                // api_category_popular
                if (0 === strpos($pathinfo, '/api/category/popular') && preg_match('#^/api/category/popular/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_category_popular');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_category_popular')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::api_popularAction',));
                }

            }

            // api_tags_all
            if (0 === strpos($pathinfo, '/api/tags/all') && preg_match('#^/api/tags/all/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_tags_all');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_tags_all')), array (  '_controller' => 'AppBundle\\Controller\\CategoryController::api_tagsAction',));
            }

        }

        if (0 === strpos($pathinfo, '/version')) {
            // app_version_add
            if ($pathinfo === '/version/add.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\VersionController::addAction',  '_route' => 'app_version_add',);
            }

            // app_version_index
            if ($pathinfo === '/version/index.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\VersionController::indexAction',  '_route' => 'app_version_index',);
            }

            // app_version_edit
            if (0 === strpos($pathinfo, '/version/edit') && preg_match('#^/version/edit/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_version_edit')), array (  '_controller' => 'AppBundle\\Controller\\VersionController::editAction',));
            }

            // app_version_delete
            if (0 === strpos($pathinfo, '/version/delete') && preg_match('#^/version/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_version_delete')), array (  '_controller' => 'AppBundle\\Controller\\VersionController::deleteAction',));
            }

        }

        // api_version_check
        if (0 === strpos($pathinfo, '/api/version/check') && preg_match('#^/api/version/check/(?P<code>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'api_version_check');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_version_check')), array (  '_controller' => 'AppBundle\\Controller\\VersionController::api_checkAction',));
        }

        if (0 === strpos($pathinfo, '/pack')) {
            if (0 === strpos($pathinfo, '/pack/s')) {
                // app_pack_sizer
                if (0 === strpos($pathinfo, '/pack/sizer') && preg_match('#^/pack/sizer/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_sizer')), array (  '_controller' => 'AppBundle\\Controller\\PackController::sizerAction',));
                }

                // app_pack_stickers
                if (0 === strpos($pathinfo, '/pack/stickers') && preg_match('#^/pack/stickers/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_stickers')), array (  '_controller' => 'AppBundle\\Controller\\PackController::stickersAction',));
                }

            }

            // app_pack_add
            if ($pathinfo === '/pack/add.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\PackController::addAction',  '_route' => 'app_pack_add',);
            }

            // app_pack_index
            if ($pathinfo === '/pack/index.html') {
                return array (  '_controller' => 'AppBundle\\Controller\\PackController::indexAction',  '_route' => 'app_pack_index',);
            }

            if (0 === strpos($pathinfo, '/pack/review')) {
                // app_pack_reviews
                if ($pathinfo === '/pack/reviews.html') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PackController::reviewsAction',  '_route' => 'app_pack_reviews',);
                }

                // app_pack_review
                if (preg_match('#^/pack/review/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_review')), array (  '_controller' => 'AppBundle\\Controller\\PackController::reviewAction',));
                }

            }

            // app_pack_edit
            if (preg_match('#^/pack/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_edit')), array (  '_controller' => 'AppBundle\\Controller\\PackController::editAction',));
            }

            // app_pack_view
            if (0 === strpos($pathinfo, '/pack/view') && preg_match('#^/pack/view/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_view')), array (  '_controller' => 'AppBundle\\Controller\\PackController::viewAction',));
            }

            // app_pack_delete
            if (0 === strpos($pathinfo, '/pack/delete') && preg_match('#^/pack/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_delete')), array (  '_controller' => 'AppBundle\\Controller\\PackController::deleteAction',));
            }

        }

        // app_pack_share
        if (0 === strpos($pathinfo, '/share') && preg_match('#^/share/(?P<id>[^/\\.]++)\\.html$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_pack_share')), array (  '_controller' => 'AppBundle\\Controller\\PackController::shareAction',));
        }

        if (0 === strpos($pathinfo, '/api')) {
            if (0 === strpos($pathinfo, '/api/pack')) {
                // api_pack_all
                if (0 === strpos($pathinfo, '/api/pack/all') && preg_match('#^/api/pack/all/(?P<page>\\d+)/(?P<order>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_pack_all');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_all')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_allAction',));
                }

                // api_pack_my
                if (0 === strpos($pathinfo, '/api/pack/my') && preg_match('#^/api/pack/my/(?P<page>\\d+)/(?P<user>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_pack_my');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_my')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_myAction',));
                }

                if (0 === strpos($pathinfo, '/api/pack/by')) {
                    // api_pack_by_category
                    if (0 === strpos($pathinfo, '/api/pack/by/category') && preg_match('#^/api/pack/by/category/(?P<page>\\d+)/(?P<order>[^/]++)/(?P<category>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_category');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_category')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_categoryAction',));
                    }

                    // api_pack_by_query
                    if (0 === strpos($pathinfo, '/api/pack/by/query') && preg_match('#^/api/pack/by/query/(?P<page>[^/]++)/(?P<query>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_query');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_query')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_queryAction',));
                    }

                    // api_pack_by_random
                    if (0 === strpos($pathinfo, '/api/pack/by/random') && preg_match('#^/api/pack/by/random/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_random');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_random')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_randomAction',));
                    }

                }

                // api_pack_add_copied
                if (0 === strpos($pathinfo, '/api/pack/add/copied') && preg_match('#^/api/pack/add/copied/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_pack_add_copied');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_add_copied')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_add_copiedAction',));
                }

                // api_pack_upload
                if (0 === strpos($pathinfo, '/api/pack/upload') && preg_match('#^/api/pack/upload/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_pack_upload');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_upload')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_uploadAction',));
                }

                if (0 === strpos($pathinfo, '/api/pack/by')) {
                    // api_pack_by_user
                    if (0 === strpos($pathinfo, '/api/pack/by/user') && preg_match('#^/api/pack/by/user/(?P<page>\\d+)/(?P<order>[^/]++)/(?P<user>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_user');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_user')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_userAction',));
                    }

                    // api_pack_by_me
                    if (0 === strpos($pathinfo, '/api/pack/by/me') && preg_match('#^/api/pack/by/me/(?P<page>\\d+)/(?P<user>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_me');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_me')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_meAction',));
                    }

                    // api_pack_by_follow
                    if (0 === strpos($pathinfo, '/api/pack/by/follow') && preg_match('#^/api/pack/by/follow/(?P<page>\\d+)/(?P<user>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_follow');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_follow')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_followAction',));
                    }

                    // api_pack_by_id
                    if (0 === strpos($pathinfo, '/api/pack/by/id') && preg_match('#^/api/pack/by/id/(?P<id>\\d+)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'api_pack_by_id');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_by_id')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_by_idAction',));
                    }

                }

                // api_pack_add_download
                if (0 === strpos($pathinfo, '/api/pack/add/download') && preg_match('#^/api/pack/add/download/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_pack_add_download;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_add_download')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_add_downloadAction',));
                }
                not_api_pack_add_download:

                // api_pack_delete
                if (0 === strpos($pathinfo, '/api/pack/delete') && preg_match('#^/api/pack/delete/(?P<token>[^/]++)/(?P<purchase>[^/]++)/$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_pack_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pack_delete')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_deleteAction',));
                }
                not_api_pack_delete:

            }

            if (0 === strpos($pathinfo, '/api/rate')) {
                // api_rate_add
                if (0 === strpos($pathinfo, '/api/rate/add') && preg_match('#^/api/rate/add/(?P<user>[^/]++)/(?P<pack>[^/]++)/(?P<value>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_rate_add');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_rate_add')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_add_rateAction',));
                }

                // api_rate_get
                if (0 === strpos($pathinfo, '/api/rate/get') && preg_match('#^/api/rate/get/(?P<user>[^/]++)/(?P<pack>[^/]++)/(?P<token>[^/]++)/(?P<purchase>[^/]++)/?$#s', $pathinfo, $matches)) {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'api_rate_get');
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_rate_get')), array (  '_controller' => 'AppBundle\\Controller\\PackController::api_get_rateAction',));
                }

            }

        }

        // app_sticker_add
        if (0 === strpos($pathinfo, '/new') && preg_match('#^/new/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_sticker_add')), array (  '_controller' => 'AppBundle\\Controller\\StickerController::addAction',));
        }

        if (0 === strpos($pathinfo, '/sticker')) {
            // app_sticker_edit
            if (preg_match('#^/sticker/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_sticker_edit')), array (  '_controller' => 'AppBundle\\Controller\\StickerController::editAction',));
            }

            // app_sticker_delete
            if (0 === strpos($pathinfo, '/sticker/delete') && preg_match('#^/sticker/delete/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_sticker_delete')), array (  '_controller' => 'AppBundle\\Controller\\StickerController::deleteAction',));
            }

            // app_sticker_up
            if (0 === strpos($pathinfo, '/sticker/up') && preg_match('#^/sticker/up/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_sticker_up')), array (  '_controller' => 'AppBundle\\Controller\\StickerController::upAction',));
            }

            // app_sticker_down
            if (0 === strpos($pathinfo, '/sticker/down') && preg_match('#^/sticker/down/(?P<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_sticker_down')), array (  '_controller' => 'AppBundle\\Controller\\StickerController::downAction',));
            }

        }

        if (0 === strpos($pathinfo, '/medias')) {
            // media_index
            if (rtrim($pathinfo, '/') === '/medias') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'media_index');
                }

                return array (  '_controller' => 'MediaBundle\\Controller\\MediaController::indexAction',  '_route' => 'media_index',);
            }

            // media_add
            if ($pathinfo === '/medias/add') {
                return array (  '_controller' => 'MediaBundle\\Controller\\MediaController::addAction',  '_route' => 'media_add',);
            }

            // media_delete
            if (0 === strpos($pathinfo, '/medias/delete') && preg_match('#^/medias/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_delete')), array (  '_controller' => 'MediaBundle\\Controller\\MediaController::deleteAction',));
            }

        }

        if (0 === strpos($pathinfo, '/api/medias')) {
            // api_media_delete
            if (0 === strpos($pathinfo, '/api/medias/delete') && preg_match('#^/api/medias/delete/(?P<id>[^/]++)/(?P<token>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'api_media_delete');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_media_delete')), array (  '_controller' => 'MediaBundle\\Controller\\MediaController::api_deleteAction',));
            }

            // media_api_upload
            if (0 === strpos($pathinfo, '/api/medias/upload') && preg_match('#^/api/medias/upload/(?P<token>[^/]++)/?$#s', $pathinfo, $matches)) {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'media_api_upload');
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'media_api_upload')), array (  '_controller' => 'MediaBundle\\Controller\\MediaController::api_uploadAction',));
            }

        }

        if (0 === strpos($pathinfo, '/media/cache/resolve')) {
            // liip_imagine_filter_runtime
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/rc/(?P<hash>[^/]++)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter_runtime;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter_runtime')), array (  '_controller' => 'liip_imagine.controller:filterRuntimeAction',));
            }
            not_liip_imagine_filter_runtime:

            // liip_imagine_filter
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter')), array (  '_controller' => 'liip_imagine.controller:filterAction',));
            }
            not_liip_imagine_filter:

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        // fos_user_change_password
        if ($pathinfo === '/profile/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'UserBundle\\Controller\\ResettingController::resetAction',));
            }
            not_fos_user_resetting_reset:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
