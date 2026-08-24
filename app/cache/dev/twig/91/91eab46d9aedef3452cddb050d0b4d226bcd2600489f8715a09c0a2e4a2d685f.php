<?php

/* AppBundle::layout.html.twig */
class __TwigTemplate_12c4ffbe7faa0025953789db0b84a3a2a72d2c264a93576e4554e4a69ea874d2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d09d62b8b2b2df2534c584b9cea47b0ff73c08c5beb2c9ff0114ba1dff7a2214 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d09d62b8b2b2df2534c584b9cea47b0ff73c08c5beb2c9ff0114ba1dff7a2214->enter($__internal_d09d62b8b2b2df2534c584b9cea47b0ff73c08c5beb2c9ff0114ba1dff7a2214_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle::layout.html.twig"));

        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\" />
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/apple-icon.png"), "html", null, true);
        echo "\" />
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/favicon.png"), "html", null, true);
        echo "\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />

    <title>Admin Panel | Stickers App</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name=\"viewport\" content=\"width=device-width\" />

    <!-- Bootstrap core CSS     -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />

    <!--  Material Dashboard CSS    -->
    <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/material-dashboard.css"), "html", null, true);
        echo "\" rel=\"stylesheet\"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/demo.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />

    <!--     Fonts and icons     -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <script src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/jscolor.js"), "html", null, true);
        echo "\"></script>
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("lib/css/emoji.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <link href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("giflib/gifplayer.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">


    <link rel=\"stylesheet\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("tags/css/normalize.css"), "html", null, true);
        echo "\">
    <!--[if IE 8]><script src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/es5.js"), "html", null, true);
        echo "\"></script><![endif]-->
    <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/jquery.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("tags/js/standalone/selectize.js"), "html", null, true);
        echo "\"></script>
    <link rel=\"stylesheet\" href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("tags/css/selectize.default.css"), "html", null, true);
        echo "\">
    <script src=\"https://kayschneider.github.io/pinbox/source/js/jquery.pinbox.min.js\"></script>
            <script>
            \$(document).ready(function () {
                /**
                 *  create new pinboxes! ;)
                 *  
                 *  avaiable parameters in the options:
                 *   every new item in the boxes uses the new item Indicator
                 *   
                 *   newitemindicator : \"new\", 
                 *   subcontainer : \".prodcont\" 
                 */
                 \$('#categoryProductContainer').pinbox().hide(0).fadeIn(1000);
            });
        </script>
</head>

<body>
    ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 56
            echo "        
        ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 58
                echo "            <div class=\"alert  alert-with-icon ";
                if (($context["type"] == "error")) {
                    echo " alert-danger ";
                } else {
                    echo "alert-dashboard";
                }
                echo "\" data-notify=\"container\"  style=\"position: absolute;right: 20px;top: 0px;z-index: 1000;\">
                <i class=\"material-icons\" data-notify=\"icon\">notifications</i>
                <button type=\"button\" aria-hidden=\"true\" class=\"close\">
                    <i class=\"material-icons\">close</i>
                </button>
                <span data-notify=\"message\">";
                // line 63
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($context["message"]), "html", null, true);
                echo "</span>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "
    <div class=\"wrapper\">
        <div class=\"sidebar\" data-active-color=\"blue\"  data-background-color=\"white\" >
              <!--
                  Tip 1: You can change the color of the sidebar using: data-color=\"purple | blue | green | orange | red\"

                  Tip 2: you can also add an image using data-image tag
              -->
              <div class=\"logo\">
                  <img src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/admin.png"), "html", null, true);
        echo "\" style=\"height: 100px;width: 100px;\">
                  <a href=\"";
        // line 77
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_index");
        echo "\" class=\"simple-text\">

                      VIDEO STATUS ADMIN
                  </a>
              </div>
              <div class=\"sidebar-wrapper\" style=\"overflow: scroll;padding-bottom: 100px;\">
                     <ul class=\"nav\">
                        <li ";
        // line 84
        if (twig_in_filter("app_home_index", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 85
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_index");
        echo "\">
                                <i class=\"material-icons\">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li ";
        // line 90
        if (twig_in_filter("app_home_notif_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"  aria-expanded=\"true\" ";
        }
        echo ">
                            <a data-toggle=\"collapse\" href=\"#notification\" class=\"\" >
                                <i class=\"material-icons\">notifications_active</i>
                                <p>Notifications
                                    <b class=\"caret\"></b>
                                </p>
                            </a>
                            <div class=\"collapse ";
        // line 97
        if (twig_in_filter("app_home_notif_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo "  in ";
        }
        echo "\" id=\"notification\" aria-expanded=\"true\" style=\"\">
                                <ul class=\"nav\">
                                    <li  ";
        // line 99
        if (twig_in_filter("app_home_notif_pack", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_pack");
        echo "\">Sticker Packs</a></li>
                                    <li  ";
        // line 100
        if (twig_in_filter("app_home_notif_category", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_category");
        echo "\">Category</a></li>
                                    <li  ";
        // line 101
        if (twig_in_filter("app_home_notif_url", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_url");
        echo "\">Url</a></li>
                                </ul>
                            </div>
                        </li>

                        <li ";
        // line 106
        if (twig_in_filter("app_slide_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 107
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_slide_index");
        echo "\">
                                <i class=\"material-icons\">slideshow</i>
                                <p>Slides</p>
                            </a>
                        </li>
                        <li ";
        // line 112
        if (twig_in_filter("app_category_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 113
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_category_index");
        echo "\">
                                <i class=\"material-icons\">view_list</i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li ";
        // line 118
        if (twig_in_filter("app_pack_i", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 119
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\">
                                <i class=\"material-icons\">inbox</i>
                                <p>Sticker Packs</p>
                            </a>
                        </li>
                        <li ";
        // line 124
        if (twig_in_filter("app_pack_r", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 125
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_reviews");
        echo "\">
                                <i class=\"material-icons\">playlist_add_check</i>
                                <p>Packs to review</p>
                            </a>
                        </li>
                        <li ";
        // line 130
        if (twig_in_filter("tag", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo ">
                            <a href=\"";
        // line 131
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_tags");
        echo "\">
                                <i class=\"material-icons\">label</i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li ";
        // line 136
        if (twig_in_filter("support", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo "  >
                            <a href=\"";
        // line 137
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_index");
        echo "\">
                            <i class=\"material-icons\">messages</i>
                                <p>Support messages</p>
                            </a>
                        </li>
                        <li ";
        // line 142
        if (twig_in_filter("version", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo "  >
                            <a href=\"";
        // line 143
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_version_index");
        echo "\">
                            <i class=\"material-icons\">apps</i>
                                <p>Versions App</p>
                            </a>
                        </li>
                        <li ";
        // line 148
        if (twig_in_filter("user", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo "  >
                            <a href=\"";
        // line 149
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_index");
        echo "\">
                            <i class=\"material-icons\">group</i><p>Users</p>
                            </a>
                        </li>
                        <li ";
        // line 153
        if (twig_in_filter("setting", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\"";
        }
        echo "  >
                            <a href=\"";
        // line 154
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_settings");
        echo "\">
                            <i class=\"material-icons\">settings</i><p>Settings</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 159
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_change_password");
        echo "\">
                            <i class=\"material-icons\">lock</i><p>Change Password</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 164
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_logout");
        echo "\">
                            <i class=\"material-icons\">exit_to_app</i><p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <div class=\"main-panel\" style=\"overflow: scroll\">
            <nav class=\"navbar navbar-transparent navbar-absolute\">
                <div class=\"container-fluid\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\">
                            <span class=\"sr-only\">Toggle navigation</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"#\">Dashboard</a>
                    </div>
                    <div class=\"collapse navbar-collapse\">

                    </div>
                </div>
            </nav>

            <div class=\"content\">
                ";
        // line 190
        $this->displayBlock('body', $context, $blocks);
        // line 193
        echo "            </div>

            <footer class=\"footer\">
            </footer>
        </div>
    </div>

</body>

    <!--   Core JS Files   -->
    <script src=\"";
        // line 203
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/jquery-3.1.0.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 204
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script src=\"";
        // line 205
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/material.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>

    <!--  Notifications Plugin    -->
    <script src=\"";
        // line 208
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/bootstrap-notify.js"), "html", null, true);
        echo "\"></script>

    <!--  Google Maps Plugin    -->
    <script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js\"></script>

    <!-- Material Dashboard javascript methods -->
    <script src=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/material-dashboard.js"), "html", null, true);
        echo "\"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src=\"";
        // line 217
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/demo.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 218
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/app.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 219
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("lib/js/config.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 220
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("lib/js/util.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 221
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("lib/js/jquery.emojiarea.js"), "html", null, true);
        echo "\"></script>
  <script src=\"";
        // line 222
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("lib/js/emoji-picker.js"), "html", null, true);
        echo "\"></script>


    <script>
      \$(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '../lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>

</html>\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000";
        
        $__internal_d09d62b8b2b2df2534c584b9cea47b0ff73c08c5beb2c9ff0114ba1dff7a2214->leave($__internal_d09d62b8b2b2df2534c584b9cea47b0ff73c08c5beb2c9ff0114ba1dff7a2214_prof);

    }

    // line 190
    public function block_body($context, array $blocks = array())
    {
        $__internal_1c2bc7019f6bf2bc6d6bec764a1f2512fff351f05016a8190d776d7c8c15e96c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1c2bc7019f6bf2bc6d6bec764a1f2512fff351f05016a8190d776d7c8c15e96c->enter($__internal_1c2bc7019f6bf2bc6d6bec764a1f2512fff351f05016a8190d776d7c8c15e96c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 191
        echo "                    
                ";
        
        $__internal_1c2bc7019f6bf2bc6d6bec764a1f2512fff351f05016a8190d776d7c8c15e96c->leave($__internal_1c2bc7019f6bf2bc6d6bec764a1f2512fff351f05016a8190d776d7c8c15e96c_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  500 => 191,  494 => 190,  468 => 222,  464 => 221,  460 => 220,  456 => 219,  452 => 218,  448 => 217,  442 => 214,  433 => 208,  427 => 205,  423 => 204,  419 => 203,  407 => 193,  405 => 190,  376 => 164,  368 => 159,  360 => 154,  354 => 153,  347 => 149,  341 => 148,  333 => 143,  327 => 142,  319 => 137,  313 => 136,  305 => 131,  299 => 130,  291 => 125,  285 => 124,  277 => 119,  271 => 118,  263 => 113,  257 => 112,  249 => 107,  243 => 106,  231 => 101,  223 => 100,  215 => 99,  208 => 97,  196 => 90,  188 => 85,  182 => 84,  172 => 77,  168 => 76,  157 => 67,  151 => 66,  142 => 63,  129 => 58,  125 => 57,  122 => 56,  118 => 55,  96 => 36,  92 => 35,  88 => 34,  84 => 33,  80 => 32,  74 => 29,  70 => 28,  65 => 26,  57 => 21,  51 => 18,  45 => 15,  33 => 6,  29 => 5,  23 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\" />
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"{{asset(\"img/apple-icon.png\")}}\" />
    <link rel=\"icon\" type=\"image/png\" href=\"{{asset(\"img/favicon.png\")}}\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />

    <title>Admin Panel | Stickers App</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name=\"viewport\" content=\"width=device-width\" />

    <!-- Bootstrap core CSS     -->
    <link href=\"{{asset(\"css/bootstrap.min.css\")}}\" rel=\"stylesheet\" />

    <!--  Material Dashboard CSS    -->
    <link href=\"{{asset(\"css/material-dashboard.css\")}}\" rel=\"stylesheet\"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=\"{{asset(\"css/demo.css\")}}\" rel=\"stylesheet\" />

    <!--     Fonts and icons     -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <script src=\"{{asset(\"js/jscolor.js\")}}\"></script>
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"{{asset(\"lib/css/emoji.css\")}}\" rel=\"stylesheet\">
    <link href=\"{{asset(\"giflib/gifplayer.css\")}}\" rel=\"stylesheet\">


    <link rel=\"stylesheet\" href=\"{{asset(\"tags/css/normalize.css\")}}\">
    <!--[if IE 8]><script src=\"{{asset(\"js/es5.js\")}}\"></script><![endif]-->
    <script src=\"{{asset(\"js/jquery.min.js\")}}\"></script>
    <script src=\"{{asset(\"tags/js/standalone/selectize.js\")}}\"></script>
    <link rel=\"stylesheet\" href=\"{{asset(\"tags/css/selectize.default.css\")}}\">
    <script src=\"https://kayschneider.github.io/pinbox/source/js/jquery.pinbox.min.js\"></script>
            <script>
            \$(document).ready(function () {
                /**
                 *  create new pinboxes! ;)
                 *  
                 *  avaiable parameters in the options:
                 *   every new item in the boxes uses the new item Indicator
                 *   
                 *   newitemindicator : \"new\", 
                 *   subcontainer : \".prodcont\" 
                 */
                 \$('#categoryProductContainer').pinbox().hide(0).fadeIn(1000);
            });
        </script>
</head>

<body>
    {% for type, messages in app.session.flashbag.all() %}
        
        {% for message in messages %}
            <div class=\"alert  alert-with-icon {% if type == \"error\" %} alert-danger {% else %}alert-dashboard{% endif %}\" data-notify=\"container\"  style=\"position: absolute;right: 20px;top: 0px;z-index: 1000;\">
                <i class=\"material-icons\" data-notify=\"icon\">notifications</i>
                <button type=\"button\" aria-hidden=\"true\" class=\"close\">
                    <i class=\"material-icons\">close</i>
                </button>
                <span data-notify=\"message\">{{message|trans}}</span>
            </div>
        {% endfor %}
    {% endfor %}

    <div class=\"wrapper\">
        <div class=\"sidebar\" data-active-color=\"blue\"  data-background-color=\"white\" >
              <!--
                  Tip 1: You can change the color of the sidebar using: data-color=\"purple | blue | green | orange | red\"

                  Tip 2: you can also add an image using data-image tag
              -->
              <div class=\"logo\">
                  <img src=\"{{asset(\"img/admin.png\")}}\" style=\"height: 100px;width: 100px;\">
                  <a href=\"{{path(\"app_home_index\")}}\" class=\"simple-text\">

                      VIDEO STATUS ADMIN
                  </a>
              </div>
              <div class=\"sidebar-wrapper\" style=\"overflow: scroll;padding-bottom: 100px;\">
                     <ul class=\"nav\">
                        <li {% if \"app_home_index\" in  app.request.attributes.get('_route') %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_home_index\")}}\">
                                <i class=\"material-icons\">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li {% if \"app_home_notif_\" in  app.request.attributes.get('_route') %} class=\"active\"  aria-expanded=\"true\" {% endif %}>
                            <a data-toggle=\"collapse\" href=\"#notification\" class=\"\" >
                                <i class=\"material-icons\">notifications_active</i>
                                <p>Notifications
                                    <b class=\"caret\"></b>
                                </p>
                            </a>
                            <div class=\"collapse {% if \"app_home_notif_\" in  app.request.attributes.get('_route') %}  in {% endif %}\" id=\"notification\" aria-expanded=\"true\" style=\"\">
                                <ul class=\"nav\">
                                    <li  {% if \"app_home_notif_pack\" in  app.request.attributes.get('_route') %} class=\"active\" {% endif %}><a href=\"{{path(\"app_home_notif_pack\")}}\">Sticker Packs</a></li>
                                    <li  {% if \"app_home_notif_category\" in  app.request.attributes.get('_route') %} class=\"active\" {% endif %}><a href=\"{{path(\"app_home_notif_category\")}}\">Category</a></li>
                                    <li  {% if \"app_home_notif_url\" in  app.request.attributes.get('_route') %} class=\"active\" {% endif %}><a href=\"{{path(\"app_home_notif_url\")}}\">Url</a></li>
                                </ul>
                            </div>
                        </li>

                        <li {% if \"app_slide_\" in  app.request.attributes.get('_route')  %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_slide_index\")}}\">
                                <i class=\"material-icons\">slideshow</i>
                                <p>Slides</p>
                            </a>
                        </li>
                        <li {% if \"app_category_\" in  app.request.attributes.get('_route')  %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_category_index\")}}\">
                                <i class=\"material-icons\">view_list</i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li {% if \"app_pack_i\" in  app.request.attributes.get('_route')  %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_pack_index\")}}\">
                                <i class=\"material-icons\">inbox</i>
                                <p>Sticker Packs</p>
                            </a>
                        </li>
                        <li {% if \"app_pack_r\" in  app.request.attributes.get('_route')  %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_pack_reviews\")}}\">
                                <i class=\"material-icons\">playlist_add_check</i>
                                <p>Packs to review</p>
                            </a>
                        </li>
                        <li {% if \"tag\" in  app.request.attributes.get('_route')  %} class=\"active\"{% endif %}>
                            <a href=\"{{path(\"app_home_tags\")}}\">
                                <i class=\"material-icons\">label</i>
                                <p>Tags</p>
                            </a>
                        </li>
                        <li {% if \"support\" in  app.request.attributes.get('_route') %} class=\"active\"{% endif %}  >
                            <a href=\"{{path(\"app_support_index\")}}\">
                            <i class=\"material-icons\">messages</i>
                                <p>Support messages</p>
                            </a>
                        </li>
                        <li {% if \"version\" in  app.request.attributes.get('_route') %} class=\"active\"{% endif %}  >
                            <a href=\"{{path(\"app_version_index\")}}\">
                            <i class=\"material-icons\">apps</i>
                                <p>Versions App</p>
                            </a>
                        </li>
                        <li {% if \"user\" in  app.request.attributes.get('_route') %} class=\"active\"{% endif %}  >
                            <a href=\"{{path(\"user_user_index\")}}\">
                            <i class=\"material-icons\">group</i><p>Users</p>
                            </a>
                        </li>
                        <li {% if \"setting\" in  app.request.attributes.get('_route') %} class=\"active\"{% endif %}  >
                            <a href=\"{{path(\"app_home_settings\")}}\">
                            <i class=\"material-icons\">settings</i><p>Settings</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"{{path(\"fos_user_change_password\")}}\">
                            <i class=\"material-icons\">lock</i><p>Change Password</p>
                            </a>
                        </li>
                        <li>
                            <a href=\"{{path(\"fos_user_security_logout\")}}\">
                            <i class=\"material-icons\">exit_to_app</i><p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <div class=\"main-panel\" style=\"overflow: scroll\">
            <nav class=\"navbar navbar-transparent navbar-absolute\">
                <div class=\"container-fluid\">
                    <div class=\"navbar-header\">
                        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\">
                            <span class=\"sr-only\">Toggle navigation</span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                            <span class=\"icon-bar\"></span>
                        </button>
                        <a class=\"navbar-brand\" href=\"#\">Dashboard</a>
                    </div>
                    <div class=\"collapse navbar-collapse\">

                    </div>
                </div>
            </nav>

            <div class=\"content\">
                {% block body %}
                    
                {% endblock %}
            </div>

            <footer class=\"footer\">
            </footer>
        </div>
    </div>

</body>

    <!--   Core JS Files   -->
    <script src=\"{{asset(\"js/jquery-3.1.0.min.js\")}}\" type=\"text/javascript\"></script>
    <script src=\"{{asset(\"js/bootstrap.min.js\")}}\" type=\"text/javascript\"></script>
    <script src=\"{{asset(\"js/material.min.js\")}}\" type=\"text/javascript\"></script>

    <!--  Notifications Plugin    -->
    <script src=\"{{asset(\"js/bootstrap-notify.js\")}}\"></script>

    <!--  Google Maps Plugin    -->
    <script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js\"></script>

    <!-- Material Dashboard javascript methods -->
    <script src=\"{{asset(\"js/material-dashboard.js\")}}\"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src=\"{{asset(\"js/demo.js\")}}\"></script>
    <script src=\"{{asset(\"js/app.js\")}}\"></script>
  <script src=\"{{asset(\"lib/js/config.js\")}}\"></script>
  <script src=\"{{asset(\"lib/js/util.js\")}}\"></script>
  <script src=\"{{asset(\"lib/js/jquery.emojiarea.js\")}}\"></script>
  <script src=\"{{asset(\"lib/js/emoji-picker.js\")}}\"></script>


    <script>
      \$(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '../lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>

</html>\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000", "AppBundle::layout.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/layout.html.twig");
    }
}
