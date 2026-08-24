<?php

/* AppBundle:Home:notif_category.html.twig */
class __TwigTemplate_d207b028ff766c090a0d7ca7bd7de21a0671cd4c4aeb68f698ccff4014f93c1c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Home:notif_category.html.twig", 1);
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
       <div class=\"col-sm-offset-2 col-md-8\">
            <div class=\"card\">
                <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                    <i class=\"material-icons\">notifications_active</i>
                </div>
                <div class=\"card-content\">
                    <h4 class=\"card-title\">Notification category</h4>
                    ";
        // line 12
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_start');
        echo "

                        <label class=\"control-label\">Notification Title</label>
                        <div class=\"form-group label-floating\">
                            ";
        // line 16
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "title", array()), 'widget', array("attr" => array("class" => "form-control", "data-emojiable" => "true", "data-emoji-input" => "unicode")));
        echo "
                            <span class=\"validate-input\">";
        // line 17
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "title", array()), 'errors');
        echo "</span>
                        </div>
                        <label class=\"control-label\">Notification Message</label>
                        <div class=\"form-group label-floating is-empty\">
                            ";
        // line 21
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "message", array()), 'widget', array("attr" => array("class" => "form-control", "data-emojiable" => "true", "data-emoji-input" => "unicode")));
        echo "
                            <span class=\"validate-input\">";
        // line 22
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "message", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating is-empty\">
                            <label class=\"control-label\">Large Icon</label>
                            ";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "icon", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 27
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "icon", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating is-empty\">
                            <label class=\"control-label\">Big Image</label>
                            ";
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "image", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 32
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "image", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"form-group label-floating \">
                            <label class=\"control-label\">Category</label>
                            ";
        // line 36
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "category", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            <span class=\"validate-input\">";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "category", array()), 'errors');
        echo "</span>
                        </div>
                        <span class=\"pull-right\">";
        // line 39
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "send", array()), 'widget', array("attr" => array("class" => "btn btn-fill btn-rose")));
        echo "</span>

                    ";
        // line 41
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
        return "AppBundle:Home:notif_category.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 41,  102 => 39,  97 => 37,  93 => 36,  86 => 32,  82 => 31,  75 => 27,  71 => 26,  64 => 22,  60 => 21,  53 => 17,  49 => 16,  42 => 12,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:notif_category.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/notif_category.html.twig");
    }
}
