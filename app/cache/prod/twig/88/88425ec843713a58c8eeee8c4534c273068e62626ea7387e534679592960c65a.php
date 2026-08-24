<?php

/* AppBundle:Support:view.html.twig */
class __TwigTemplate_abe2a6a08dacbfde112480de979e5e5006588409c786fa81537540acd20fe5c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Support:view.html.twig", 2);
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

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"container-fluid\">

    <div class=\"row\">
        <div class=\"col-sm-offset-1  col-md-4\">
            <a href=\"";
        // line 8
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_index");
        echo "\" class=\"btn btn-default btn-lg add-button\" title=\"\"><i class=\"material-icons\">arrow_back</i> Messages </a>
        </div>
        <div class=\"col-md-5\">
            <a href=\"mailto:";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute(($context["support"] ?? null), "email", array()), "html", null, true);
        echo "?subject=feedback\"  class=\"btn btn-primary btn-lg add-button pull-right\" title=\"\"><i class=\"material-icons\">reply</i> Reply </a>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-sm-offset-1 col-md-9\">
            <div class=\"card card-product\" >
                <center><h2>";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute(($context["support"] ?? null), "subject", array()), "html", null, true);
        echo "</h2></center>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-sm-offset-1  col-md-9\">
        
        <div class=\"card\" >
            <div class=\"card-header ch-dark palette-Teal-600 bg\"  style=\"background:white !important\">
                <h2><small>Full name : ";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute(($context["support"] ?? null), "subject", array()), "html", null, true);
        echo " <br>
                E-mail : ";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute(($context["support"] ?? null), "email", array()), "html", null, true);
        echo "</small>
                </h2>
            </div>

            <div class=\"card-header ch-dark palette-Teal-600 bg\" style=\"background:white !important\">
              
                    <div >Message</div>
                    <div style=\"padding:40px; text-align: justify;padding:40px;\">
                        ";
        // line 35
        echo $this->getAttribute(($context["support"] ?? null), "message", array());
        echo "
                        <br>
                        <br>
                        <br>
                        <ul class=\"lgi-attrs pull-right\">
                            Sending Date:";
        // line 40
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["support"] ?? null), "created", array()), "d/m/Y"), "html", null, true);
        echo " at ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["support"] ?? null), "created", array()), "H:i"), "html", null, true);
        echo "
                        </ul>
                    </div>

            </div>
        </div>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:Support:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 40,  79 => 35,  68 => 27,  64 => 26,  52 => 17,  43 => 11,  37 => 8,  31 => 4,  28 => 3,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Support:view.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Support/view.html.twig");
    }
}
