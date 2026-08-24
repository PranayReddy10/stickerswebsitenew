<?php

/* AppBundle:Home:index.html.twig */
class __TwigTemplate_c044a14835a7cfb8c1b3babb293b2bfc7245b6a17d7001d6f78cf427635adf6b extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
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
        echo twig_escape_filter($this->env, ($context["downloads"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["searchs"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["packs"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["reviews"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["stickers"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["categories"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["tags"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["slides"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["users"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["supports"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["versions"] ?? null), "html", null, true);
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
        echo twig_escape_filter($this->env, ($context["devices"] ?? null), "html", null, true);
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
        return array (  286 => 190,  270 => 177,  263 => 173,  248 => 161,  241 => 157,  226 => 145,  219 => 141,  204 => 129,  197 => 125,  182 => 113,  175 => 109,  160 => 97,  153 => 93,  138 => 81,  131 => 77,  116 => 65,  109 => 61,  94 => 49,  87 => 45,  71 => 32,  64 => 28,  49 => 16,  42 => 12,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:index.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/index.html.twig");
    }
}
