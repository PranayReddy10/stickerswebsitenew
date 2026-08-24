<?php

/* AppBundle:Home:privacypolicy.html.twig */
class __TwigTemplate_e709b16c459d759090a679bfbe3e49fe873c5f83ff395dd7267ca5499ba21125 extends Twig_Template
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
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<title>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appname", array()), "html", null, true);
        echo " - Privacy Policy</title>
</head>
<body style=\"padding:10px\">
";
        // line 7
        echo $this->getAttribute(($context["setting"] ?? null), "privacypolicy", array());
        echo "
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Home:privacypolicy.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 7,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:privacypolicy.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/privacypolicy.html.twig");
    }
}
