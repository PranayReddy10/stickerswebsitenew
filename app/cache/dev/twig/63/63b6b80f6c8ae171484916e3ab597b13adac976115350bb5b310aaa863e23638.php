<?php

/* AppBundle:Pack:stickers.html.twig */
class __TwigTemplate_815a67339185cc060e6451b3decb6b3817149ed9caf0ba2a6e827e5318db6de7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Pack:stickers.html.twig", 1);
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
        $__internal_52cb29b9e88db36dfef2d86b22390b41a7e856846e74aea3453352b010d2660a = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_52cb29b9e88db36dfef2d86b22390b41a7e856846e74aea3453352b010d2660a->enter($__internal_52cb29b9e88db36dfef2d86b22390b41a7e856846e74aea3453352b010d2660a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Pack:stickers.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_52cb29b9e88db36dfef2d86b22390b41a7e856846e74aea3453352b010d2660a->leave($__internal_52cb29b9e88db36dfef2d86b22390b41a7e856846e74aea3453352b010d2660a_prof);

    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        $__internal_3e011488e10f149564de1b5cb31026163a72dd933b96815dc549eeb691568dec = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3e011488e10f149564de1b5cb31026163a72dd933b96815dc549eeb691568dec->enter($__internal_3e011488e10f149564de1b5cb31026163a72dd933b96815dc549eeb691568dec_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "\t<div class=\"container-fluid\">
\t\t<div class=\"row\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"";
        // line 7
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">arrow_back</i> PACK LIST </a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> ";
        // line 10
        echo twig_escape_filter($this->env, ($context["count"] ?? $this->getContext($context, "count")), "html", null, true);
        echo " Sticker(s)</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "get", array(0 => "id"), "method"))), "html", null, true);
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t<div class=\"card-header card-header-icon\" data-background-color=\"rose\">
\t\t\t\t\t\t\t<i class=\"material-icons\">inbox</i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t<h4 class=\"card-title\">";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "name", array()), "html", null, true);
        echo " stickers  <span class=\"label label-danger label-lg pull-right\" style=\"font-size:14px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "sizes", array()), "html", null, true);
        echo "</span></h4>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"pack-image\" style=\"    margin-top: 12px;\">
\t\t\t\t\t\t\t\t\t<div class=\"path-image-img\"><img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "image", array()), "link", array())), "html", null, true);
        echo "\" class=\"thumbnail\" id=\"img-preview\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"form-right-view\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack name</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "name", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack publisher</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "publisher", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher E-mail</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "publisheremail", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher Website</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "publisherwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website privacy policy</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "privacypolicywebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website license agreement</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "licenseagreementwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t";
        // line 63
        if ($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "enabled", array())) {
            // line 64
            echo "\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled</span>
\t\t\t\t\t\t\t\t";
        } else {
            // line 66
            echo "\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled</span>
\t\t\t\t\t\t\t\t";
        }
        // line 68
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t";
        // line 71
        if ($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "premium", array())) {
            // line 72
            echo "\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Premium Pack</span>
\t\t\t\t\t\t\t\t";
        } else {
            // line 74
            echo "\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Free Pack</span>
\t\t\t\t\t\t\t\t";
        }
        // line 76
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<h4>Categories : </h4>
\t\t\t\t\t\t\t\t";
        // line 79
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 80
            echo "\t\t\t\t\t\t\t\t\t<span class=\"label label-rose \" style=\"margin:5px;\"> <b> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "title", array()), "html", null, true);
            echo " </b></span>  
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo "\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\" >
\t\t\t\t\t\t\t\t<h4>Tags : </h4>
\t\t\t\t\t\t\t\t";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "tagslist", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 89
            echo "\t\t\t\t\t\t\t\t\t<span class=\"label label-rose \" style=\"margin:5px;\"> <b> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
            echo " </b></span>  
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        echo "\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t<hr>
\t\t\t\t\t\t\t<div class=\"card-footer\">
\t\t\t\t\t\t\t\t<div class=\"wallpaper-logo\" >
\t\t\t\t\t\t\t\t\t";
        // line 98
        if (($this->getAttribute($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "user", array()), "image", array()) == "")) {
            // line 99
            echo "\t\t\t\t\t\t\t\t\t\t";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "user", array()), "name", array()), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 101
            echo "\t\t\t\t\t\t\t\t\t\t<img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "user", array()), "image", array()), "html", null, true);
            echo "\" class=\"avatar-img\" alt=\"\"> 
\t\t\t\t\t\t\t\t\t";
        }
        // line 103
        echo "\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "user", array()), "name", array()), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">|</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">";
        // line 105
        echo $this->env->getExtension('Knp\Bundle\TimeBundle\Twig\Extension\TimeExtension')->diff($this->getAttribute(($context["pack"] ?? $this->getContext($context, "pack")), "created", array()));
        echo "</span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<a href=\"";
        // line 114
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_add", array("id" => $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "request", array()), "get", array(0 => "id"), "method"))), "html", null, true);
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">add</i> NEW STICKER</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\"  id=\"categoryProductContainer\">
\t\t\t\t";
        // line 118
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stickers"] ?? $this->getContext($context, "stickers")));
        foreach ($context['_seq'] as $context["_key"] => $context["sticker"]) {
            // line 119
            echo "\t\t\t\t\t<div class=\"col-md-3 span2 pcon prodcont actioninside new\">
\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t\t<h3></h3>
\t\t\t\t\t\t\t\t<img src=\"";
            // line 123
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($context["sticker"], "media", array()), "link", array())), "html", null, true);
            echo "\" style=\"width:100%; height:auto;    border-radius: 5px;border:1px solid #ccc;padding:10px\" >
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card-footer\" style=\"    text-align: center;margin:0px\">
\t\t\t\t\t\t\t\t<a href=\"";
            // line 127
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_edit", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 130
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_delete", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 133
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_up", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-info btn-xs btn-round\" data-original-title=\"Up\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">keyboard_arrow_up</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 136
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_down", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-info btn-xs btn-round\" data-original-title=\"Down\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">keyboard_arrow_down</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sticker'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 143
        echo "\t\t\t</div>
\t\t</div>
\t</div>
\t";
        
        $__internal_3e011488e10f149564de1b5cb31026163a72dd933b96815dc549eeb691568dec->leave($__internal_3e011488e10f149564de1b5cb31026163a72dd933b96815dc549eeb691568dec_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:stickers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 143,  284 => 136,  278 => 133,  272 => 130,  266 => 127,  259 => 123,  253 => 119,  249 => 118,  242 => 114,  230 => 105,  224 => 103,  218 => 101,  212 => 99,  210 => 98,  201 => 91,  192 => 89,  188 => 88,  180 => 82,  171 => 80,  167 => 79,  162 => 76,  158 => 74,  154 => 72,  152 => 71,  147 => 68,  143 => 66,  139 => 64,  137 => 63,  129 => 58,  122 => 54,  113 => 48,  106 => 44,  96 => 37,  89 => 33,  81 => 28,  71 => 23,  58 => 13,  52 => 10,  46 => 7,  40 => 3,  34 => 2,  11 => 1,);
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
\t\t\t\t\t<a href=\"{{path(\"app_pack_index\")}}\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">arrow_back</i> PACK LIST </a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> {{count}} Sticker(s)</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"{{path(\"app_pack_stickers\",{\"id\":app.request.get(\"id\")})}}\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t<div class=\"card-header card-header-icon\" data-background-color=\"rose\">
\t\t\t\t\t\t\t<i class=\"material-icons\">inbox</i>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t<h4 class=\"card-title\">{{pack.name}} stickers  <span class=\"label label-danger label-lg pull-right\" style=\"font-size:14px;\">{{pack.sizes}}</span></h4>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"pack-image\" style=\"    margin-top: 12px;\">
\t\t\t\t\t\t\t\t\t<div class=\"path-image-img\"><img src=\"{{asset(pack.image.link)}}\" class=\"thumbnail\" id=\"img-preview\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"form-right-view\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack name</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"{{pack.name}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack publisher</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"{{pack.publisher}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher E-mail</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"{{pack.publisheremail}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher Website</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"{{pack.publisherwebsite}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website privacy policy</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"{{pack.privacypolicywebsite}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website license agreement</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"{{pack.licenseagreementwebsite}}\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t{% if pack.enabled %}
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled</span>
\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled</span>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t{% if pack.premium %}
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Premium Pack</span>
\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Free Pack</span>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<h4>Categories : </h4>
\t\t\t\t\t\t\t\t{% for category in pack.categories %}
\t\t\t\t\t\t\t\t\t<span class=\"label label-rose \" style=\"margin:5px;\"> <b> {{category.title}} </b></span>  
\t\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\" >
\t\t\t\t\t\t\t\t<h4>Tags : </h4>
\t\t\t\t\t\t\t\t{% for tag in pack.tagslist %}
\t\t\t\t\t\t\t\t\t<span class=\"label label-rose \" style=\"margin:5px;\"> <b> {{tag.name}} </b></span>  
\t\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>\t
\t\t\t\t\t\t\t<hr>
\t\t\t\t\t\t\t<div class=\"card-footer\">
\t\t\t\t\t\t\t\t<div class=\"wallpaper-logo\" >
\t\t\t\t\t\t\t\t\t{% if pack.user.image == \"\" %}
\t\t\t\t\t\t\t\t\t\t{{pack.user.name}}
\t\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t\t<img src=\"{{pack.user.image}}\" class=\"avatar-img\" alt=\"\"> 
\t\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">{{pack.user.name}}</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">|</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">{{pack.created|ago}}</span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-12\">
\t\t\t\t\t<a href=\"{{path(\"app_sticker_add\",{\"id\":app.request.get(\"id\")})}}\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">add</i> NEW STICKER</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\"  id=\"categoryProductContainer\">
\t\t\t\t{% for sticker in stickers %}
\t\t\t\t\t<div class=\"col-md-3 span2 pcon prodcont actioninside new\">
\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t<div class=\"card-content\">
\t\t\t\t\t\t\t\t<h3></h3>
\t\t\t\t\t\t\t\t<img src=\"{{asset(sticker.media.link)}}\" style=\"width:100%; height:auto;    border-radius: 5px;border:1px solid #ccc;padding:10px\" >
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card-footer\" style=\"    text-align: center;margin:0px\">
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_sticker_edit\",{\"id\":sticker.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_sticker_delete\",{\"id\":sticker.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_sticker_up\",{\"id\":sticker.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-info btn-xs btn-round\" data-original-title=\"Up\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">keyboard_arrow_up</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"{{path(\"app_sticker_down\",{\"id\":sticker.id})}}\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-info btn-xs btn-round\" data-original-title=\"Down\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">keyboard_arrow_down</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t{% endfor %}
\t\t\t</div>
\t\t</div>
\t</div>
\t{% endblock%}", "AppBundle:Pack:stickers.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/stickers.html.twig");
    }
}
