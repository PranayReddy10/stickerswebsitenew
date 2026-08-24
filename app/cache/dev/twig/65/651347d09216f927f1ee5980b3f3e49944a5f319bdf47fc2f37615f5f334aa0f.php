<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_5be1c98202186cad204a097933a0078a28e286f1fc77a67f6a6cfc598bd964db extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d75367a7bf2c57db92f3e712823979bf9c521f48484de08b7dd70d51fbdb836d = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d75367a7bf2c57db92f3e712823979bf9c521f48484de08b7dd70d51fbdb836d->enter($__internal_d75367a7bf2c57db92f3e712823979bf9c521f48484de08b7dd70d51fbdb836d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Security:login.html.twig"));

        // line 1
        echo "<html lang=\"en\">
<head>
    <meta charset=\"utf-8\" />
    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/apple-icon.png"), "html", null, true);
        echo "\" />
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/favicon.png"), "html", null, true);
        echo "\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />
    <title>Admin Panel | Stickers App</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name=\"viewport\" content=\"width=device-width\" />


    <!-- Bootstrap core CSS     -->
    <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
    <!--  Material Dashboard CSS    -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/material-dashboard.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/demo.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
    <!--     Fonts and icons     -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons\" />
</head>
<body style=\"background-color: #000000 !important;\">

    <div class=\"wrapper wrapper-full-page\">
        <div class=\"full-page login-page\" filter-color=\"black\" >
            <!--   you can change the color of the filter page using: data-color=\"blue | purple | green | orange | red | rose \" -->
            <div class=\"content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                           

                        
                            <form method=\"post\" action=\"";
        // line 34
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_check");
        echo "\">
                                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, ($context["csrf_token"] ?? $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\" />
                                <div class=\"card card-login \">
                                    <br>
                                    <center><img src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/admin.png"), "html", null, true);
        echo "\" style=\"    height: 106px;    width: auto;\"></center>
                                    <br>
                                    
                                    ";
        // line 41
        if (($context["error"] ?? $this->getContext($context, "error"))) {
            // line 42
            echo "                                        <div class=\"card-content\" style=\"padding-right:10px\">
                                            <div class=\"alert alert-danger\">
                                                <span>
                                                   <b>Erreur ! </b>  ";
            // line 45
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans(($context["error"] ?? $this->getContext($context, "error")), array(), "FOSUserBundle"), "html", null, true);
            echo "</span>
                                            </div>
                                        </div>
                                    ";
        }
        // line 48
        echo "   
                                    <div class=\"card-content\">
                                        <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                <i class=\"material-icons\">email</i>
                                            </span>
                                            <div class=\"form-group label-floating\">
                                                 <input type=\"text\" class=\"form-control\" id=\"username\" name=\"_username\" value=\"";
        // line 55
        echo twig_escape_filter($this->env, ($context["last_username"] ?? $this->getContext($context, "last_username")), "html", null, true);
        echo "\" required=\"required\" />
                                            </div>
                                        </div>
                                        <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                <i class=\"material-icons\">lock_outline</i>
                                            </span>
                                            <div class=\"form-group label-floating\">
                                                <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" required=\"required\" />
                                            </div>
                                        </div>
                                        <div class=\"input-group\" style=\"padding:16px\">
                                            <label>
                                                <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"> ";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                                            </label>
                                        </div>

                                    </div>
                                    <div class=\"footer text-center\">
                                        <button type=\"submit\" class=\"btn btn-fill btn-rose\">";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</body>
<script src=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/jquery-3.1.1.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
<script src=\"";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/jquery-ui.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
<script src=\"";
        // line 89
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
<script src=\"";
        // line 90
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/material.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
<!-- Material Dashboard javascript methods -->
<script src=\"";
        // line 92
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("js/material-dashboard.js"), "html", null, true);
        echo "\"></script>
</html>



\000\000";
        
        $__internal_d75367a7bf2c57db92f3e712823979bf9c521f48484de08b7dd70d51fbdb836d->leave($__internal_d75367a7bf2c57db92f3e712823979bf9c521f48484de08b7dd70d51fbdb836d_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 92,  164 => 90,  160 => 89,  156 => 88,  152 => 87,  136 => 74,  127 => 68,  111 => 55,  102 => 48,  95 => 45,  90 => 42,  88 => 41,  82 => 38,  76 => 35,  72 => 34,  52 => 17,  47 => 15,  42 => 13,  31 => 5,  27 => 4,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<html lang=\"en\">
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
    <link href=\"{{asset(\"css/material-dashboard.css\")}}\" rel=\"stylesheet\" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href=\"{{asset(\"css/demo.css\")}}\" rel=\"stylesheet\" />
    <!--     Fonts and icons     -->
    <link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons\" />
</head>
<body style=\"background-color: #000000 !important;\">

    <div class=\"wrapper wrapper-full-page\">
        <div class=\"full-page login-page\" filter-color=\"black\" >
            <!--   you can change the color of the filter page using: data-color=\"blue | purple | green | orange | red | rose \" -->
            <div class=\"content\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3\">
                           

                        
                            <form method=\"post\" action=\"{{ path(\"fos_user_security_check\") }}\">
                                <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token }}\" />
                                <div class=\"card card-login \">
                                    <br>
                                    <center><img src=\"{{asset(\"img/admin.png\")}}\" style=\"    height: 106px;    width: auto;\"></center>
                                    <br>
                                    
                                    {% if error %}
                                        <div class=\"card-content\" style=\"padding-right:10px\">
                                            <div class=\"alert alert-danger\">
                                                <span>
                                                   <b>Erreur ! </b>  {{ error|trans({}, 'FOSUserBundle') }}</span>
                                            </div>
                                        </div>
                                    {% endif %}   
                                    <div class=\"card-content\">
                                        <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                <i class=\"material-icons\">email</i>
                                            </span>
                                            <div class=\"form-group label-floating\">
                                                 <input type=\"text\" class=\"form-control\" id=\"username\" name=\"_username\" value=\"{{ last_username }}\" required=\"required\" />
                                            </div>
                                        </div>
                                        <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                <i class=\"material-icons\">lock_outline</i>
                                            </span>
                                            <div class=\"form-group label-floating\">
                                                <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" required=\"required\" />
                                            </div>
                                        </div>
                                        <div class=\"input-group\" style=\"padding:16px\">
                                            <label>
                                                <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"> {{ 'security.login.remember_me'|trans({}, 'FOSUserBundle') }}
                                            </label>
                                        </div>

                                    </div>
                                    <div class=\"footer text-center\">
                                        <button type=\"submit\" class=\"btn btn-fill btn-rose\">{{ 'security.login.submit'|trans({}, 'FOSUserBundle') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</body>
<script src=\"{{asset(\"js/jquery-3.1.1.min.js\")}}\" type=\"text/javascript\"></script>
<script src=\"{{asset(\"js/jquery-ui.min.js\")}}\" type=\"text/javascript\"></script>
<script src=\"{{asset(\"js/bootstrap.min.js\")}}\" type=\"text/javascript\"></script>
<script src=\"{{asset(\"js/material.min.js\")}}\" type=\"text/javascript\"></script>
<!-- Material Dashboard javascript methods -->
<script src=\"{{asset(\"js/material-dashboard.js\")}}\"></script>
</html>



\000\000", "FOSUserBundle:Security:login.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/UserBundle/Resources/views/Security/login.html.twig");
    }
}
