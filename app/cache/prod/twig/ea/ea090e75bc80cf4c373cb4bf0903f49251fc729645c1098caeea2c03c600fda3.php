<?php

/* AppBundle:Pack:share.html.twig */
class __TwigTemplate_a7ca07282e1e5c74807c0ee83c060ff26c4510dff32ae30ee11364cdaad82830 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"en\">
<head>
    <title>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appname", array()), "html", null, true);
        echo "</title>
    <!-- Required meta tags -->
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"title\" content=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appname", array()), "html", null, true);
        echo "\">
    <meta name=\"description\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appdescription", array()), "html", null, true);
        echo "\">
    <link rel=\"dns-prefetch\" href=\"//fonts.googleapis.com\">
    <link href=\"https://fonts.googleapis.com/css?family=Rubik:300,400,500\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/bootstrap.min.css"), "html", null, true);
        echo "\">
    <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
</head>
<body data-spy=\"scroll\" data-target=\"#navbar\" data-offset=\"30\">
    <!-- Nav Menu -->
    <header class=\"bg-gradient\" id=\"home\">
        <div class=\"container mt-5\">
            <h1>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appname", array()), "html", null, true);
        echo "</h1>
            <p class=\"tagline\">";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "appdescription", array()), "html", null, true);
        echo "</p>
            <br>
            <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute(($context["setting"] ?? null), "googleplay", array()), "html", null, true);
        echo "\"><img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/gplay.png"), "html", null, true);
        echo "\" style=\"    width: 350px;\" class=\"img\"></a>
            <br>
            <br>
            <div class=\"img-holder mt-3\"><img src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute(($context["setting"] ?? null), "media", array()), "link", array())), "html", null, true);
        echo "\" alt=\"phone\" class=\"img-fluid img\"></div>
        </div>
    </header>
</body>

</html>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:share.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 25,  63 => 22,  58 => 20,  54 => 19,  45 => 13,  41 => 12,  35 => 9,  31 => 8,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Pack:share.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/share.html.twig");
    }
}
