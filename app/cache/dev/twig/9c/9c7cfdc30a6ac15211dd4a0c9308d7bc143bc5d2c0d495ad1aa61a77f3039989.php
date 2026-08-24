<?php

/* AppBundle:Pack:index.html.twig */
class __TwigTemplate_f737553e45196d4741b13d9b305e022ec095d4f4f645aefe6eb29edf5e202925 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Pack:index.html.twig", 1);
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
        $__internal_d0ac412a100b35c54c5a5df8acf623824f7ecef7c7ec3b5296d2cf0ab6c38081 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d0ac412a100b35c54c5a5df8acf623824f7ecef7c7ec3b5296d2cf0ab6c38081->enter($__internal_d0ac412a100b35c54c5a5df8acf623824f7ecef7c7ec3b5296d2cf0ab6c38081_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Pack:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d0ac412a100b35c54c5a5df8acf623824f7ecef7c7ec3b5296d2cf0ab6c38081->leave($__internal_d0ac412a100b35c54c5a5df8acf623824f7ecef7c7ec3b5296d2cf0ab6c38081_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_9fb458625e28b1f578fbd00ceabe7b84d386b902ebe465cf3026c289db7fa8c2 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_9fb458625e28b1f578fbd00ceabe7b84d386b902ebe465cf3026c289db7fa8c2->enter($__internal_9fb458625e28b1f578fbd00ceabe7b84d386b902ebe465cf3026c289db7fa8c2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        echo twig_escape_filter($this->env, ($context["count"] ?? $this->getContext($context, "count")), "html", null, true);
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
        $context['_seq'] = twig_ensure_traversable(($context["packs"] ?? $this->getContext($context, "packs")));
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
                if ((($context["index"] ?? $this->getContext($context, "index")) < 10)) {
                    // line 39
                    echo "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-sticker\"><img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($context["sticker"], "media", array()), "link", array())), "html", null, true);
                    echo "\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t";
                }
                // line 41
                echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                $context["index"] = (($context["index"] ?? $this->getContext($context, "index")) + 1);
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
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_edit", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit Stickers\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">list</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_view", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"View\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">remove_red_eye</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_notif_pack", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Send Notification\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">notifications</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 64
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_delete", array("id" => $this->getAttribute($context["pack"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<div class=\"price\">
\t\t\t\t\t\t\t\t\t<div class=\"wallpaper-logo\" >
\t\t\t\t\t\t\t\t\t\t";
            // line 69
            if (($this->getAttribute($this->getAttribute($context["pack"], "user", array()), "image", array()) == "")) {
                // line 70
                echo "\t\t\t\t\t\t\t\t\t\t\t";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["pack"], "user", array()), "name", array()), "html", null, true);
                echo "
\t\t\t\t\t\t\t\t\t\t";
            } else {
                // line 72
                echo "\t\t\t\t\t\t\t\t\t\t\t<img src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["pack"], "user", array()), "image", array()), "html", null, true);
                echo "\" class=\"avatar-img\" alt=\"\">
\t\t\t\t\t\t\t\t\t\t";
            }
            // line 74
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
            // line 82
            echo "\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"card\"  style=\"text-align: center;\" >
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<img src=\"";
            // line 86
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
        // line 92
        echo "\t\t\t\t
\t\t\t</div>
\t\t\t<div class=\" pull-right\">
\t\t\t\t";
        // line 95
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, ($context["packs"] ?? $this->getContext($context, "packs")));
        echo "
\t\t\t</div>
\t\t</div>
\t";
        
        $__internal_9fb458625e28b1f578fbd00ceabe7b84d386b902ebe465cf3026c289db7fa8c2->leave($__internal_9fb458625e28b1f578fbd00ceabe7b84d386b902ebe465cf3026c289db7fa8c2_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 95,  214 => 92,  202 => 86,  196 => 82,  180 => 74,  174 => 72,  168 => 70,  166 => 69,  158 => 64,  152 => 61,  146 => 58,  140 => 55,  134 => 52,  123 => 43,  117 => 42,  114 => 41,  108 => 39,  105 => 38,  100 => 37,  98 => 36,  91 => 34,  87 => 33,  80 => 28,  75 => 27,  58 => 13,  52 => 10,  46 => 7,  40 => 3,  34 => 2,  11 => 1,);
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
\t<div class=\"container-fluid\">
\t\t<div class=\"row\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"{{path(\"app_pack_index\")}}\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> {{count}} packs</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"{{path(\"app_pack_add\")}}\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">add_box</i> NEW PACK </a>
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
\t\t\t\t{% for pack in packs %}
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t\t<div class=\"pack-item\">
\t\t\t\t\t\t\t\t\t<div class=\"pack-header\">
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-image\"><img src=\"{{asset(pack.image.link)}}\"></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-title\"><p>{{pack.name}} - {{pack.sizes}}</p></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"pack-body\">
\t\t\t\t\t\t\t\t\t\t\t{% set index = 0 %}
\t\t\t\t\t\t\t\t\t\t\t{% for sticker in pack.stickers %}
\t\t\t\t\t\t\t\t\t\t\t\t{% if index < 10 %}
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"pack-item-sticker\"><img src=\"{{asset(sticker.media.link)}}\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t\t\t\t{% set index = index + 1 %}
\t\t\t\t\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<img src=\"\" style=\"width:100%; height:auto;    border-radius: 5px;\" >
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card-footer\" style=\"    text-align: left;\">
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_pack_edit\",{\"id\":pack.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_pack_stickers\",{\"id\":pack.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit Stickers\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">list</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_pack_view\",{\"id\":pack.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"View\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">remove_red_eye</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_home_notif_pack\",{\"id\":pack.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Send Notification\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">notifications</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_pack_delete\",{\"id\":pack.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<div class=\"price\">
\t\t\t\t\t\t\t\t\t<div class=\"wallpaper-logo\" >
\t\t\t\t\t\t\t\t\t\t{% if pack.user.image == \"\" %}
\t\t\t\t\t\t\t\t\t\t\t{{pack.user.name}}
\t\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t\t<img src=\"{{pack.user.image}}\" class=\"avatar-img\" alt=\"\">
\t\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t\t<span>{{pack.user.name}}<br>{{pack.created|ago}}</span>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t{% else %}
\t\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t\t<div class=\"card\"  style=\"text-align: center;\" >
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<img src=\"{{asset(\"img/bg_empty.png\")}}\"  style=\"width: auto !important;\" =\"\">
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t{% endfor %}
\t\t\t\t
\t\t\t</div>
\t\t\t<div class=\" pull-right\">
\t\t\t\t{{ knp_pagination_render(packs) }}
\t\t\t</div>
\t\t</div>
\t{% endblock%}", "AppBundle:Pack:index.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/index.html.twig");
    }
}
