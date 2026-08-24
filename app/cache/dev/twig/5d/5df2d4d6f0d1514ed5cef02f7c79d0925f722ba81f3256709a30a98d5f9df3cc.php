<?php

/* AppBundle:Home:index.html.twig */
class __TwigTemplate_65ba2f1c83b1c181012684457b78b21e87632ccfc4e669451629be01250ef3c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Home:index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_03548da1a8fa9449026e578e2749929b984ec12baed309e2d713d2ff272d3296 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_03548da1a8fa9449026e578e2749929b984ec12baed309e2d713d2ff272d3296->enter($__internal_03548da1a8fa9449026e578e2749929b984ec12baed309e2d713d2ff272d3296_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Home:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_03548da1a8fa9449026e578e2749929b984ec12baed309e2d713d2ff272d3296->leave($__internal_03548da1a8fa9449026e578e2749929b984ec12baed309e2d713d2ff272d3296_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_291d6556fe179270d9d809b73ff0026a8ea77734e0b6f4e7453b582696acf3be = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_291d6556fe179270d9d809b73ff0026a8ea77734e0b6f4e7453b582696acf3be->enter($__internal_291d6556fe179270d9d809b73ff0026a8ea77734e0b6f4e7453b582696acf3be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">cloud_download</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Downloads</p>
                     <h3 class=\"title\">";
        // line 12
        echo twig_escape_filter($this->env, ($context["downloads"] ?? $this->getContext($context, "downloads")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 16
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">search</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Searchs</p>
                     <h3 class=\"title\">";
        // line 28
        echo twig_escape_filter($this->env, ($context["searchs"] ?? $this->getContext($context, "searchs")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 32
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_tags");
        echo "\">Popular words asked</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">folder</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Live Packs</p>
                     <h3 class=\"title\">";
        // line 45
        echo twig_escape_filter($this->env, ($context["packs"] ?? $this->getContext($context, "packs")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 49
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">access_time</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Reviews</p>
                     <h3 class=\"title\">";
        // line 61
        echo twig_escape_filter($this->env, ($context["reviews"] ?? $this->getContext($context, "reviews")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 65
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_reviews");
        echo "\">Reviews list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">insert_emoticon</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Live Stickers</p>
                     <h3 class=\"title\">";
        // line 77
        echo twig_escape_filter($this->env, ($context["stickers"] ?? $this->getContext($context, "stickers")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 81
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">category</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Categories</p>
                     <h3 class=\"title\">";
        // line 93
        echo twig_escape_filter($this->env, ($context["categories"] ?? $this->getContext($context, "categories")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 97
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_category_index");
        echo "\">Categories list</a>
                    </div>
                </div>
            </div>
        </div>   
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">label</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Tags</p>
                     <h3 class=\"title\">";
        // line 109
        echo twig_escape_filter($this->env, ($context["tags"] ?? $this->getContext($context, "tags")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 113
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_tags");
        echo "\">Tags list</a>
                    </div>
                </div>
            </div>
        </div>  
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">slideshow</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Slides</p>
                     <h3 class=\"title\">";
        // line 125
        echo twig_escape_filter($this->env, ($context["slides"] ?? $this->getContext($context, "slides")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 129
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_slide_index");
        echo "\">Slides list</a>
                    </div>
                </div>
            </div>
        </div>    
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">person</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Users</p>
                     <h3 class=\"title\">";
        // line 141
        echo twig_escape_filter($this->env, ($context["users"] ?? $this->getContext($context, "users")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 145
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_index");
        echo "\">video list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">chat</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Messages</p>
                     <h3 class=\"title\">";
        // line 157
        echo twig_escape_filter($this->env, ($context["supports"] ?? $this->getContext($context, "supports")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 161
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_index");
        echo "\">Support Message list</a>
                    </div>
                </div>
            </div>
        </div>    
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">system_update</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Versions</p>
                     <h3 class=\"title\">";
        // line 173
        echo twig_escape_filter($this->env, ($context["versions"] ?? $this->getContext($context, "versions")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"";
        // line 177
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_version_index");
        echo "\">Versions list</a>
                    </div>
                </div>
            </div>
        </div>    

        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"red\">
                    <i class=\"material-icons\">devices_other</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Installs</p>
                     <h3 class=\"title\">";
        // line 190
        echo twig_escape_filter($this->env, ($context["devices"] ?? $this->getContext($context, "devices")), "html", null, true);
        echo "</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">perm_device_information</i><span> Application install</span> 
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
";
        
        $__internal_291d6556fe179270d9d809b73ff0026a8ea77734e0b6f4e7453b582696acf3be->leave($__internal_291d6556fe179270d9d809b73ff0026a8ea77734e0b6f4e7453b582696acf3be_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Home:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  295 => 190,  279 => 177,  272 => 173,  257 => 161,  250 => 157,  235 => 145,  228 => 141,  213 => 129,  206 => 125,  191 => 113,  184 => 109,  169 => 97,  162 => 93,  147 => 81,  140 => 77,  125 => 65,  118 => 61,  103 => 49,  96 => 45,  80 => 32,  73 => 28,  58 => 16,  51 => 12,  40 => 3,  34 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"AppBundle::layout.html.twig\" %}
{% block body%}
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">cloud_download</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Downloads</p>
                     <h3 class=\"title\">{{downloads}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_pack_index\")}}\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">search</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Searchs</p>
                     <h3 class=\"title\">{{searchs}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_home_tags\")}}\">Popular words asked</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">folder</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Live Packs</p>
                     <h3 class=\"title\">{{packs}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_pack_index\")}}\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">access_time</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Reviews</p>
                     <h3 class=\"title\">{{reviews}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_pack_reviews\")}}\">Reviews list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">insert_emoticon</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Live Stickers</p>
                     <h3 class=\"title\">{{stickers}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_pack_index\")}}\">Pack list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">category</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Categories</p>
                     <h3 class=\"title\">{{categories}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_category_index\")}}\">Categories list</a>
                    </div>
                </div>
            </div>
        </div>   
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">label</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Tags</p>
                     <h3 class=\"title\">{{tags}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_home_tags\")}}\">Tags list</a>
                    </div>
                </div>
            </div>
        </div>  
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">slideshow</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Slides</p>
                     <h3 class=\"title\">{{slides}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_slide_index\")}}\">Slides list</a>
                    </div>
                </div>
            </div>
        </div>    
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">person</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Users</p>
                     <h3 class=\"title\">{{users}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"user_user_index\")}}\">video list</a>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">chat</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Messages</p>
                     <h3 class=\"title\">{{supports}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_support_index\")}}\">Support Message list</a>
                    </div>
                </div>
            </div>
        </div>    
        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"green\">
                    <i class=\"material-icons\">system_update</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Versions</p>
                     <h3 class=\"title\">{{versions}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">keyboard_arrow_right</i><a href=\"{{path(\"app_version_index\")}}\">Versions list</a>
                    </div>
                </div>
            </div>
        </div>    

        <div class=\"col-lg-4 col-md-6 col-sm-6\">
            <div class=\"card card-stats\">
                <div class=\"card-header\" data-background-color=\"red\">
                    <i class=\"material-icons\">devices_other</i>
                </div>
                <div class=\"card-content\">
                    <p class=\"category\">Installs</p>
                     <h3 class=\"title\">{{devices}}</h3>
                </div>
                <div class=\"card-footer\">
                    <div class=\"stats\">
                        <i class=\"material-icons\">perm_device_information</i><span> Application install</span> 
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
{% endblock%}", "AppBundle:Home:index.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/index.html.twig");
    }
}
