<?php

/* AppBundle:Home:settings.html.twig */
class __TwigTemplate_49d344ca4311788edb5c67705ac87dcf1cb8a0b25bf4df147350b0e633752569 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Home:settings.html.twig", 1);
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
            <div class=\"col-md-3\">
                <div class=\"card\">
                    <div class=\"tab-moivie\">
                        <a href=\"";
        // line 8
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_settings");
        echo "\" class=\"btn btn-tab-movie-active col-md-12\"><i class=\"material-icons\">settings</i> Settings</a>
                        <a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_ads");
        echo "\" class=\"btn btn-tab-movie col-md-12\"><i class=\"material-icons\">monetization_on</i> Ads Settings</a>
                        <a href=\"";
        // line 10
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_change_password");
        echo "\" class=\"btn btn-tab-movie col-md-12\"><i class=\"material-icons\">lock</i> Change password</a>
                    </div>
                </div>
            </div>

       <div class=\"col-md-9\">
            <div class=\"card\">
                <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                    <i class=\"material-icons\">settings</i>
                </div>
                <div class=\"card-content\">
                    <h4 class=\"card-title\">Settings</h4>
                    ";
        // line 22
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_start');
        echo "
                        <br>
                        <div class=\"form-group label-floating\">
                            <label class=\"control-label\">App Name : </label>
                            ";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appname", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 27
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appname", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating\">
                            <label class=\"control-label\">App Description : </label>
                            ";
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appdescription", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 32
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appdescription", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating\">
                            <label class=\"control-label\">Firebase Legacy server key : </label>
                            ";
        // line 36
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "firebasekey", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "firebasekey", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating\">
                            <label class=\"control-label\">Application url on google play : </label>
                            ";
        // line 41
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "googleplay", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 42
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "googleplay", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating\">
                            <label class=\"control-label\">Privacy Policy : </label>
                            ";
        // line 46
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "privacypolicy", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 47
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "privacypolicy", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"fileinput fileinput-new text-center\" style=\"    width: 100%;\" data-provides=\"fileinput\">
                            <div class=\"fileinput-new thumbnail\" style=\"    width: 100%;\">
                                <img  id=\"img-preview\" src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["form"] ?? null), "vars", array()), "value", array()), "media", array()), "link", array())), "html", null, true);
        echo "\"  width=\"100%\">
                                                                <a href=\"#\" class=\"btn btn-rose btn-round btn-select\"><i class=\"material-icons\">image</i> Select image </a>

                            </div>
                           ";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "file", array()), 'widget', array("attr" => array("class" => "file-hidden input-file img-selector", "style" => "    display: none;")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 57
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "file", array()), 'errors');
        echo "</span>
                       </div>
                        <span class=\"pull-right\"><a href=\"";
        // line 59
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_category_index");
        echo "\" class=\"btn btn-fill btn-yellow\"><i class=\"material-icons\">arrow_back</i> Cancel</a>";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "save", array()), 'widget', array("attr" => array("class" => "btn btn-fill btn-rose")));
        echo "</span>
                    ";
        // line 60
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_end');
        echo "
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Home:settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 60,  140 => 59,  135 => 57,  130 => 55,  123 => 51,  116 => 47,  112 => 46,  105 => 42,  101 => 41,  94 => 37,  90 => 36,  83 => 32,  79 => 31,  72 => 27,  68 => 26,  61 => 22,  46 => 10,  42 => 9,  38 => 8,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:settings.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/settings.html.twig");
    }
}
