<?php

/* AppBundle:Pack:reviews.html.twig */
class __TwigTemplate_d84e8d99abcd4b6f62b74858fc709f97de511d411f838899212a82bb66c6c20b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Pack:reviews.html.twig", 1);
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
        echo "\t<div class=\"container-fluid\">
\t\t<div class=\"row\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"";
        // line 7
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> ";
        // line 10
        echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
        echo " packs</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"";
        // line 13
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_add");
        echo "\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">add_box</i> NEW PACK </a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<form method=\"get\" accept-charset=\"utf-8\">
\t\t\t\t<div class=\"col-md-10\">
\t\t\t\t\t\t<input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search here\" style=\"height:53px\">
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-2\">
\t\t\t\t\t<button type=\"submit\" class=\"btn  btn-md btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">search</i></button>
\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["packs"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["pack"]) {
            // line 28
            echo "\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t\t<div class=\"pack-item\">
\t\t\t\t\t\t\t\t\t<div class=\"pack-header\">
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-image\"><img src=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($context["pack"], "image", array()), "link", array())), "html", null, true);
            echo "\"></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-title\"><p>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["pack"], "name", array()), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pack"], "sizes", array()), "html", null, true);
            echo "</p></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-body\">
\t\t\t\t\t\t\t\t\t\t\t";
            // line 36
            $context["index"] = 0;
            // line 37
            echo "\t\t\t\t\t\t\t\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["pack"], "stickers", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["sticker"]) {
                // line 38
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                if ((($context["index"] ?? null) < 10)) {
                    // line 39
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-sticker\"><img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($context["sticker"], "media", array()), "link", array())), "html", null, true);
                    echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 41
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                $context["index"] = (($context["index"] ?? null) + 1);
                // line 42
                echo "\t\t\t\t\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sticker'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<img src=\"\" style=\"width:100%; height:auto;    border-radius: 5px;\" >
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card-footer\" style=\"    text-align: left;\">
\t\t\t\t\t\t\t\t<a href=\"";
            // line 52
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_review", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Review\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">check</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit Stickers\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">list</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_delete", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<div class=\"price\">
\t\t\t\t\t\t\t\t\t<div class=\"wallpaper-logo\" >
\t\t\t\t\t\t\t\t\t\t";
            // line 63
            if (($this->getAttribute($this->getAttribute($context["pack"], "user", array()), "image", array()) == "")) {
                // line 64
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["pack"], "user", array()), "name", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 66
                echo "\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["pack"], "user", array()), "image", array()), "html", null, true);
                echo "\" class=\"avatar-img\" alt=\"\">
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 68
            echo "\t\t\t\t\t\t\t\t\t\t<span>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["pack"], "user", array()), "name", array()), "html", null, true);
            echo "<br>";
            echo $this->env->getExtension('Knp\Bundle\TimeBundle\Twig\Extension\TimeExtension')->diff($this->getAttribute($context["pack"], "created", array()));
            echo "</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 76
            echo "\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"card\"  style=\"text-align: center;\" >
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<img src=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/bg_empty.png"), "html", null, true);
            echo "\"  style=\"width: auto !important;\" =\"\">
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pack'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "\t\t\t\t
\t\t\t</div>
\t\t\t<div class=\" pull-right\">
\t\t\t\t";
        // line 89
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, ($context["packs"] ?? null));
        echo "
\t\t\t</div>
\t\t</div>
\t";
    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:reviews.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 89,  193 => 86,  181 => 80,  175 => 76,  159 => 68,  153 => 66,  147 => 64,  145 => 63,  137 => 58,  131 => 55,  125 => 52,  114 => 43,  108 => 42,  105 => 41,  99 => 39,  96 => 38,  91 => 37,  89 => 36,  82 => 34,  78 => 33,  71 => 28,  66 => 27,  49 => 13,  43 => 10,  37 => 7,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Pack:reviews.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/reviews.html.twig");
    }
}
