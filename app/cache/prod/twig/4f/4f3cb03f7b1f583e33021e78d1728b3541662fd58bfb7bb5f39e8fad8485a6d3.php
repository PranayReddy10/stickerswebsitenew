<?php

/* AppBundle:Pack:stickers.html.twig */
class __TwigTemplate_a4d71c8e1b0257d24b894973a0270ada98088d862aee393b9f4cbdd5f3f9c853 extends Twig_Template
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
        echo "\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">arrow_back</i> PACK LIST </a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> ";
        // line 10
        echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
        echo " Sticker(s)</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t<a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "get", array(0 => "id"), "method"))), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "name", array()), "html", null, true);
        echo " stickers  <span class=\"label label-danger label-lg pull-right\" style=\"font-size:14px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "sizes", array()), "html", null, true);
        echo "</span></h4>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"pack-image\" style=\"    margin-top: 12px;\">
\t\t\t\t\t\t\t\t\t<div class=\"path-image-img\"><img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute(($context["pack"] ?? null), "image", array()), "link", array())), "html", null, true);
        echo "\" class=\"thumbnail\" id=\"img-preview\"></div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"form-right-view\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack name</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "name", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Pack publisher</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisher", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher E-mail</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisheremail", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Publisher Website</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisherwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website privacy policy</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"name\" class=\"form-control\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "privacypolicywebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-group label-floating \">
\t\t\t\t\t\t\t\t\t\t<label class=\"control-label\">Website license agreement</label>
\t\t\t\t\t\t\t\t\t\t<input name=\"publisher\" class=\"form-control\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "licenseagreementwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t\t";
        // line 63
        if ($this->getAttribute(($context["pack"] ?? null), "enabled", array())) {
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
        if ($this->getAttribute(($context["pack"] ?? null), "premium", array())) {
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
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? null), "categories", array()));
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
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? null), "tagslist", array()));
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
        if (($this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "image", array()) == "")) {
            // line 99
            echo "\t\t\t\t\t\t\t\t\t\t";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "name", array()), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t";
        } else {
            // line 101
            echo "\t\t\t\t\t\t\t\t\t\t<img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "image", array()), "html", null, true);
            echo "\" class=\"avatar-img\" alt=\"\"> 
\t\t\t\t\t\t\t\t\t";
        }
        // line 103
        echo "\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "name", array()), "html", null, true);
        echo "</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">|</span>
\t\t\t\t\t\t\t\t\t<span style=\"    line-height: 26px;font-size: 16px;\">";
        // line 105
        echo $this->env->getExtension('Knp\Bundle\TimeBundle\Twig\Extension\TimeExtension')->diff($this->getAttribute(($context["pack"] ?? null), "created", array()));
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
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_add", array("id" => $this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "get", array(0 => "id"), "method"))), "html", null, true);
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">add</i> NEW STICKER</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"row\"  id=\"categoryProductContainer\">
\t\t\t\t";
        // line 118
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stickers"] ?? null));
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
\t\t\t\t\t\t\t\t<!-- IMAGE URL BELOW IMAGE -->
    <div style=\"
        margin-top:6px;
        font-size:12px;
        color:#555;
        word-break:break-all;
        background:#f7f7f7;
        padding:5px;
        border-radius:4px;
    \">
        ";
            // line 135
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["sticker"], "media", array()), "link", array()), "html", null, true);
            echo "
    </div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"card-footer\" style=\"    text-align: center;margin:0px\">
\t\t\t\t\t\t\t\t<a href=\"";
            // line 139
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_edit", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"Edit\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">edit</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 142
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_delete", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">delete</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 145
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_sticker_up", array("id" => $this->getAttribute($context["sticker"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"bottom\" class=\" btn btn-info btn-xs btn-round\" data-original-title=\"Up\">
\t\t\t\t\t\t\t\t\t<i class=\"material-icons\">keyboard_arrow_up</i>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t<a href=\"";
            // line 148
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
        // line 155
        echo "\t\t\t</div>
\t\t</div>
\t</div>
\t";
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
        return array (  303 => 155,  290 => 148,  284 => 145,  278 => 142,  272 => 139,  265 => 135,  250 => 123,  244 => 119,  240 => 118,  233 => 114,  221 => 105,  215 => 103,  209 => 101,  203 => 99,  201 => 98,  192 => 91,  183 => 89,  179 => 88,  171 => 82,  162 => 80,  158 => 79,  153 => 76,  149 => 74,  145 => 72,  143 => 71,  138 => 68,  134 => 66,  130 => 64,  128 => 63,  120 => 58,  113 => 54,  104 => 48,  97 => 44,  87 => 37,  80 => 33,  72 => 28,  62 => 23,  49 => 13,  43 => 10,  37 => 7,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Pack:stickers.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/stickers.html.twig");
    }
}
