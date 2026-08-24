<?php

/* AppBundle:Support:index.html.twig */
class __TwigTemplate_61a542a5b8698356953dd44567e081194751ea4039deabbf17717a5da9de34d7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Support:index.html.twig", 1);
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
        echo "
<div class=\"container-fluid\">
    <div class=\"row\">
\t\t<div class=\"col-md-12\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t<a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_index");
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t<a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">flag</i> ";
        // line 12
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["supports"] ?? null)), "html", null, true);
        echo " Messages</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"card\">
\t\t\t    <div class=\"card-content\">
\t\t\t        <h4 class=\"card-title\">Messages list</h4>
\t\t\t        <div class=\"table-responsive\">
\t\t\t            <table class=\"table\" width=\"100%\">
\t\t\t                <thead class=\"text-primary\">
\t\t\t                \t<tr>
\t\t\t                    <th>id</th>
\t\t\t                    <th>E-mail</th>
\t\t\t                    <th>Subject</th>
\t\t\t                    <th>Date</th>
\t\t\t                    <th width=\"160px\">Action</th>
\t\t\t                \t</tr>
\t\t\t                </thead>
\t\t\t                <tbody>
\t\t\t                ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pagination"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["support"]) {
            // line 31
            echo "\t\t\t                    <tr>
\t\t\t                        <td>";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["support"], "id", array()), "html", null, true);
            echo "</td>
\t\t\t                        <td>";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute($context["support"], "email", array()), "html", null, true);
            echo "</td>
\t\t\t                        <td>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["support"], "subject", array()), "html", null, true);
            echo "</td>
\t\t\t                        <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["support"], "created", array()), "Y/m/d - H:i"), "html", null, true);
            echo "</td>
\t\t\t                        <td>
\t\t                                <a href=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_view", array("id" => $this->getAttribute($context["support"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"left\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"View\">
\t\t                                    <i class=\"material-icons\">pageview</i>
\t\t                                </a>
\t\t                                <a href=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_support_delete", array("id" => $this->getAttribute($context["support"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"left\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
\t\t                                    <i class=\"material-icons\">delete</i>
\t\t                                </a>
\t\t\t                        </td>
\t\t\t                    </tr>
\t\t\t                    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 46
            echo "\t\t\t\t\t\t          <tr>
\t\t\t\t\t\t\t          <td colspan=\"4\">
\t\t\t\t\t\t\t\t          <br>
\t\t\t\t\t\t\t\t          <br>
\t\t\t\t\t\t\t\t          <center><img src=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/bg_empty.png"), "html", null, true);
            echo "\"  style=\"width: auto !important;\" =\"\"></center>
\t\t\t\t\t\t\t              <br>
\t\t\t\t\t\t\t              <br>
\t\t\t\t\t\t\t          </td>
\t\t\t\t\t\t          </tr>\t
\t\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['support'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "\t\t\t                </tbody>
\t\t\t            </table>

\t\t\t        </div>
\t    \t\t</div>
\t\t\t<div class=\" pull-right\">
\t\t\t\t";
        // line 62
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, ($context["pagination"] ?? null));
        echo "
\t\t\t</div>
\t    \t</div>
\t    </div>
\t</div>
                            
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Support:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 62,  126 => 56,  114 => 50,  108 => 46,  97 => 40,  91 => 37,  86 => 35,  82 => 34,  78 => 33,  74 => 32,  71 => 31,  66 => 30,  45 => 12,  39 => 9,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Support:index.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Support/index.html.twig");
    }
}
