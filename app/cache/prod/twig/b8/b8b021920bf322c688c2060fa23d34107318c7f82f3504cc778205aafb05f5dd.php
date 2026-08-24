<?php

/* AppBundle:Home:tags.html.twig */
class __TwigTemplate_620c73b968f13aa9bf6b0063f6fdd231157066316afeb9fd075c9f3161d129f8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Home:tags.html.twig", 1);
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
    <div class=\"col-md-12\">
        <div class=\"row\">
      <div class=\"col-md-4\">
        <a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_tags");
        echo "\" class=\"btn  btn-lg btn-warning\" style=\"    width: 100%;\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
      </div>
      <div class=\"col-md-4\">
        <a class=\"btn btn btn-lg btn-yellow\" style=\"    width: 100%;\"><i class=\"material-icons\" style=\"font-size: 30px;\">view_list</i> TAGS :  ";
        // line 12
        echo twig_escape_filter($this->env, twig_length_filter($this->env, ($context["tags"] ?? null)), "html", null, true);
        echo " </a>
      </div>
    </div>
      <div class=\"card\">
          <div class=\"card-content\">
              <h4 class=\"card-title\">Messages list</h4>
              <div class=\"table-responsive\">
                  <table class=\"table\" width=\"100%\">
                      <thead class=\"text-primary\">
                        <tr>
                          <th>Tag</th>
                          <th>Search Number</th>
                          <th width=\"160px\">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tags"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 29
            echo "                          <tr>
                              <td><span class=\"label label-success\">";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
            echo "</span></td>
                              <td>";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "search", array()), "html", null, true);
            echo "</td>
                              <td>
                                <a href=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_tags_delete", array("id" => $this->getAttribute($context["tag"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"left\" class=\" btn btn-danger btn-xs btn-round\" data-original-title=\"Delete\">
                                        <i class=\"material-icons\">delete</i>
                                    </a>
                                </td>
                          </tr>
                          ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 39
            echo "                      <tr>
                        <td colspan=\"4\">
                          <br>
                          <br>
                          <center><img src=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/bg_empty.png"), "html", null, true);
            echo "\"  style=\"width: auto !important;\" =\"\"></center>
                            <br>
                            <br>
                        </td>
                      </tr> 
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "                      </tbody>
                  </table>

              </div>
          </div>
      <div class=\" pull-right\">
        ";
        // line 55
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, ($context["tags"] ?? null));
        echo "
      </div>
        </div>
      </div>
  </div>
                            
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Home:tags.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 55,  110 => 49,  98 => 43,  92 => 39,  81 => 33,  76 => 31,  72 => 30,  69 => 29,  64 => 28,  45 => 12,  39 => 9,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:tags.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/tags.html.twig");
    }
}
