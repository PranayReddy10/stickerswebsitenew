<?php

/* AppBundle::layout.html.twig */
class __TwigTemplate_ef3905703945b4273baae005873f8743db98af4a09980e1e322ef6b75baaa70f extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "session", array()), "flashbag", array()), "all", array(), "method"));
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
        if (twig_in_filter("app_home_index", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_home_notif_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_home_notif_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo "  in ";
        }
        echo "\" id=\"notification\" aria-expanded=\"true\" style=\"\">
                                <ul class=\"nav\">
                                    <li  ";
        // line 99
        if (twig_in_filter("app_home_notif_pack", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_pack");
        echo "\">Sticker Packs</a></li>
                                    <li  ";
        // line 100
        if (twig_in_filter("app_home_notif_category", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_category");
        echo "\">Category</a></li>
                                    <li  ";
        // line 101
        if (twig_in_filter("app_home_notif_url", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_slide_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_category_", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_pack_i", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("app_pack_r", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("tag", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("support", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("version", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("user", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
        if (twig_in_filter("setting", $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "attributes", array()), "get", array(0 => "_route"), "method"))) {
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
    }

    // line 190
    public function block_body($context, array $blocks = array())
    {
        // line 191
        echo "                    
                ";
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
        return array (  491 => 191,  488 => 190,  465 => 222,  461 => 221,  457 => 220,  453 => 219,  449 => 218,  445 => 217,  439 => 214,  430 => 208,  424 => 205,  420 => 204,  416 => 203,  404 => 193,  402 => 190,  373 => 164,  365 => 159,  357 => 154,  351 => 153,  344 => 149,  338 => 148,  330 => 143,  324 => 142,  316 => 137,  310 => 136,  302 => 131,  296 => 130,  288 => 125,  282 => 124,  274 => 119,  268 => 118,  260 => 113,  254 => 112,  246 => 107,  240 => 106,  228 => 101,  220 => 100,  212 => 99,  205 => 97,  193 => 90,  185 => 85,  179 => 84,  169 => 77,  165 => 76,  154 => 67,  148 => 66,  139 => 63,  126 => 58,  122 => 57,  119 => 56,  115 => 55,  93 => 36,  89 => 35,  85 => 34,  81 => 33,  77 => 32,  71 => 29,  67 => 28,  62 => 26,  54 => 21,  48 => 18,  42 => 15,  30 => 6,  26 => 5,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle::layout.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/layout.html.twig");
    }
}
