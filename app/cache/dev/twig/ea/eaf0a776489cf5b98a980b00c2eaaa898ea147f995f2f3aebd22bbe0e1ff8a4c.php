<?php

/* AppBundle:Sticker:edit.html.twig */
class __TwigTemplate_9a5b70b04b93ef7ed0c699e48f19cb4e828529a944416694026798a07a1ad709 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Sticker:edit.html.twig", 1);
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
        $__internal_d9e4c5b594c4e6e4eac76ff5db4bc524880c7d79f36b58ef09fda2d840c52ea7 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_d9e4c5b594c4e6e4eac76ff5db4bc524880c7d79f36b58ef09fda2d840c52ea7->enter($__internal_d9e4c5b594c4e6e4eac76ff5db4bc524880c7d79f36b58ef09fda2d840c52ea7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sticker:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d9e4c5b594c4e6e4eac76ff5db4bc524880c7d79f36b58ef09fda2d840c52ea7->leave($__internal_d9e4c5b594c4e6e4eac76ff5db4bc524880c7d79f36b58ef09fda2d840c52ea7_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_3e571ac52be09160528da88443c88b30c64510d7590919616fabae6e30fec94f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_3e571ac52be09160528da88443c88b30c64510d7590919616fabae6e30fec94f->enter($__internal_3e571ac52be09160528da88443c88b30c64510d7590919616fabae6e30fec94f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-sm-offset-2 col-md-8\">
            <div class=\"card\">

                <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                    <i class=\"material-icons\">insert_emoticon</i>
                </div>

                <div class=\"card-content\">
                    <h4 class=\"card-title\">Edit Sticker</h4>

                    <!-- HARD FORM ACTION (NO 404 POSSIBLE) -->
                    <form method=\"post\" action=\"/sticker/";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute(($context["sticker"] ?? $this->getContext($context, "sticker")), "id", array()), "html", null, true);
        echo ".html\" enctype=\"multipart/form-data\">

                        <!-- IMAGE PREVIEW -->
                        <div class=\"thumbnail\" style=\"width:100%;\">
                            <img
                                id=\"img-preview\"
                                src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["sticker"] ?? $this->getContext($context, "sticker")), "media", array()), "link", array()), "html", null, true);
        echo "\"
                                width=\"100%\"
                                style=\"border-radius:5px;border:1px solid #ccc;padding:10px;\"
                            >
                        </div>

                        <!-- IMAGE URL INPUT -->
                        <div class=\"form-group\">
                            <label>Image URL</label>
                            <input
                                type=\"text\"
                                name=\"image_url\"
                                class=\"form-control\"
                                value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["sticker"] ?? $this->getContext($context, "sticker")), "media", array()), "link", array()), "html", null, true);
        echo "\"
                                oninput=\"
                                    document.getElementById('img-preview').src =
                                    this.value + '?t=' + new Date().getTime();
                                \"
                            >
                        </div>

                        <!-- FILE UPLOAD (OPTIONAL) -->
                        <div class=\"form-group\">
                            <label>Upload Image</label>
                            <input type=\"file\" name=\"file\" class=\"form-control\">
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class=\"pull-right\">
                            <a href=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($this->getAttribute(($context["sticker"] ?? $this->getContext($context, "sticker")), "pack", array()), "id", array()))), "html", null, true);
        echo "\"
                               class=\"btn btn-fill btn-yellow\">
                                <i class=\"material-icons\">arrow_back</i> Cancel
                            </a>

                            <button type=\"submit\" class=\"btn btn-fill btn-rose\">
                                Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_3e571ac52be09160528da88443c88b30c64510d7590919616fabae6e30fec94f->leave($__internal_3e571ac52be09160528da88443c88b30c64510d7590919616fabae6e30fec94f_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sticker:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 52,  80 => 36,  64 => 23,  55 => 17,  40 => 4,  34 => 3,  11 => 1,);
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

{% block body %}
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-sm-offset-2 col-md-8\">
            <div class=\"card\">

                <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                    <i class=\"material-icons\">insert_emoticon</i>
                </div>

                <div class=\"card-content\">
                    <h4 class=\"card-title\">Edit Sticker</h4>

                    <!-- HARD FORM ACTION (NO 404 POSSIBLE) -->
                    <form method=\"post\" action=\"/sticker/{{ sticker.id }}.html\" enctype=\"multipart/form-data\">

                        <!-- IMAGE PREVIEW -->
                        <div class=\"thumbnail\" style=\"width:100%;\">
                            <img
                                id=\"img-preview\"
                                src=\"{{ sticker.media.link }}\"
                                width=\"100%\"
                                style=\"border-radius:5px;border:1px solid #ccc;padding:10px;\"
                            >
                        </div>

                        <!-- IMAGE URL INPUT -->
                        <div class=\"form-group\">
                            <label>Image URL</label>
                            <input
                                type=\"text\"
                                name=\"image_url\"
                                class=\"form-control\"
                                value=\"{{ sticker.media.link }}\"
                                oninput=\"
                                    document.getElementById('img-preview').src =
                                    this.value + '?t=' + new Date().getTime();
                                \"
                            >
                        </div>

                        <!-- FILE UPLOAD (OPTIONAL) -->
                        <div class=\"form-group\">
                            <label>Upload Image</label>
                            <input type=\"file\" name=\"file\" class=\"form-control\">
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class=\"pull-right\">
                            <a href=\"{{ path('app_pack_stickers', {id: sticker.pack.id}) }}\"
                               class=\"btn btn-fill btn-yellow\">
                                <i class=\"material-icons\">arrow_back</i> Cancel
                            </a>

                            <button type=\"submit\" class=\"btn btn-fill btn-rose\">
                                Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "AppBundle:Sticker:edit.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Sticker/edit.html.twig");
    }
}
