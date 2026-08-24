<?php

/* UserBundle:User:edit.html.twig */
class __TwigTemplate_ffa2e2b79b3cdfc3adac28d063ffcf3153911ae11b5d3725c76684a77f78d05a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "UserBundle:User:edit.html.twig", 1);
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
        echo "   <div class=\"container-fluid\">
    <div class=\"row\">
         <div class=\"col-md-12\" style=\" height: auto; text-align:center;background-image:url(";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute(($context["user"] ?? null), "image", array())), "html", null, true);
        echo ");background-position: center;background-size: 100%;text-align: center;\">
                <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute(($context["user"] ?? null), "image", array())), "html", null, true);
        echo "\" alt=\"\" style=\"border-radius:300px;margin:10px;height:100px;width:100px;border: 5px solid rgb(255, 247, 247);\">
                <h3 style=\" color: white; font-weight: bold\">";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user"] ?? null), "name", array()), "html", null, true);
        echo "</h3>
         </div>
        <div  class=\"col-md-12\" style=\"border:1px solid #ccc;height:70px;background:white\">
             <div class=\"row\">
                <div  class=\"col-md-3\" style=\"border-right:1px solid #ccc;height:70px;background:white\">
                <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_edit", array("id" => $this->getAttribute(($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" style=\"color:black;font-size:20px;line-height: 70px;font-weight: bold;\">Edit infos</a>
                </div>
                <div  class=\"col-md-3\" style=\"border-right:1px solid #ccc;height:70px;background:white\">
                <a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_followings", array("id" => $this->getAttribute(($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" style=\"color:black;font-size:20px;line-height: 70px;font-weight: bold;\">";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute(($context["user"] ?? null), "users", array())), "html", null, true);
        echo " Following </a>
                </div>
                <div  class=\"col-md-3\" style=\"border-right:1px solid #ccc;height:70px;background:white\">
                <a href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_followers", array("id" => $this->getAttribute(($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" style=\"color:black;font-size:20px;line-height: 70px;font-weight: bold;\">";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute(($context["user"] ?? null), "followers", array())), "html", null, true);
        echo " Followers </a>
                </div>
                <div  class=\"col-md-3\" style=\"height:70px;background:white\">
                <a href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_packs", array("id" => $this->getAttribute(($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" style=\"color:black;font-size:20px;line-height: 70px;font-weight: bold;\">";
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute(($context["user"] ?? null), "packs", array())), "html", null, true);
        echo " Packs </a>
                </div>
             </div>       
        </div>
        <div  class=\"col-md-12\" style=\"height:20px;\">
                    
        </div>
       <div class=\"col-sm-offset-2  col-md-8\">
            <div class=\"card\">
                <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                    <i class=\"material-icons\">group</i>
                </div>
                <div class=\"card-content\">
                <br>
               <div class=\"card-body card-padding\">
                ";
        // line 36
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_start', array("attr" => array("class" => "form-horizontal")));
        echo "
                    <div class=\"form-group fg-line\">
                        ";
        // line 38
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "name", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 39
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "name", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 40
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "name", array()), 'errors');
        echo "
                    </div>

                    <div class=\"form-group fg-line\">
                        ";
        // line 44
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "email", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 45
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "email", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 46
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "email", array()), 'errors');
        echo "
                    </div>
                    <div class=\"form-group fg-line\">
                        ";
        // line 49
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "type", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 50
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "type", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 51
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "type", array()), 'errors');
        echo "
                    </div>
                    <div class=\"form-group fg-line\">
                        ";
        // line 54
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "facebook", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "facebook", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 56
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "facebook", array()), 'errors');
        echo "
                    </div>
                    <div class=\"form-group fg-line\">
                        ";
        // line 59
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "emailo", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 60
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "emailo", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 61
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "emailo", array()), 'errors');
        echo "
                    </div>
                    <div class=\"form-group fg-line\">
                        ";
        // line 64
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "instagram", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 65
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "instagram", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 66
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "instagram", array()), 'errors');
        echo "
                    </div>
                    <div class=\"form-group fg-line\">
                        ";
        // line 69
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "twitter", array()), 'label', array("label_attr" => array("class" => "")));
        echo "
                        ";
        // line 70
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "twitter", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                        ";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "twitter", array()), 'errors');
        echo "
                    </div>
                    <div >
                        <label>
                            ";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "enabled", array()), 'widget');
        echo "
                            Enabled
                        </label>
                    </div>
                    <div >
                        <label>
                            ";
        // line 81
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "trusted", array()), 'widget');
        echo "
                            Trusted (Add Pack without Review)
                        </label>
                    </div>

                    <br>
                    ";
        // line 87
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "save", array()), 'widget', array("attr" => array("class" => "btn btn-success btn-lg waves-effect pull-right")));
        echo "
                ";
        // line 88
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_end');
        echo "
                <br>
                <br>
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
        return "UserBundle:User:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 88,  216 => 87,  207 => 81,  198 => 75,  191 => 71,  187 => 70,  183 => 69,  177 => 66,  173 => 65,  169 => 64,  163 => 61,  159 => 60,  155 => 59,  149 => 56,  145 => 55,  141 => 54,  135 => 51,  131 => 50,  127 => 49,  121 => 46,  117 => 45,  113 => 44,  106 => 40,  102 => 39,  98 => 38,  93 => 36,  73 => 21,  65 => 18,  57 => 15,  51 => 12,  43 => 7,  39 => 6,  35 => 5,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "UserBundle:User:edit.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/UserBundle/Resources/views/User/edit.html.twig");
    }
}
