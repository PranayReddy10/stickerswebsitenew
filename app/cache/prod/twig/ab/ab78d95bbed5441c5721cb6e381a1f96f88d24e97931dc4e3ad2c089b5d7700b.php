<?php

/* UserBundle:User:index.html.twig */
class __TwigTemplate_0486a136c938db40b4bbb87d71308e39f7e267ad68cbec63f12746dac751bbb9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "UserBundle:User:index.html.twig", 1);
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
        // line 12
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_index");
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
      </div>
      <div class=\"col-md-4\">
        <a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">queue_music</i> ";
        // line 15
        echo twig_escape_filter($this->env, (twig_length_filter($this->env, ($context["users"] ?? null)) - 1), "html", null, true);
        echo " users</a>
      </div>
      <div class=\"col-md-4\">
        <form method=\"get\" class=\"btn btn  btn-yellow\" style=\"    width: 100%;\">
              <input type=\"text\" placeholder=\"Email/Nom\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "query", array()), "get", array(0 => "q"), "method"), "html", null, true);
        echo "\" name=\"q\" style=\"background: none;border: none;border-bottom: 1px solid white;\">
          <button type=\"submit\" style=\"background: none;border: none;\"><i class=\"material-icons\" style=\"font-size: 40px;\">search</i></button>
        </form>
      </div>
    </div>
      <div class=\"card\">
          <div class=\"card-content\">
              <h4 class=\"card-title\">Messages list</h4>
              <div class=\"table-responsive\">
                  <table class=\"table\" width=\"100%\">
                      <thead class=\"text-primary\">
                        <tr>
                          <th width=\"70px\">#</th>
                          <th>Full name</th>
                          <th>Facebook/Google Id</th>
                          <th>Enabled</th>
                          <th>State</th>
                          <th width=\"160px\">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pagination"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 41
            echo "                          <tr>
                              <td width=\"70px\">       
                                <div class=\"avatar\">             
                                ";
            // line 44
            if (($this->getAttribute($context["user"], "image", array()) != null)) {
                // line 45
                echo "                                    <img class=\"avatar-char palette-Red-400 bg\"  style=\"border-radius: 100px;    border: 0.5px solid #ccc;\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($context["user"], "image", array())), "html", null, true);
                echo "\" alt=\"\">
                                ";
            }
            // line 47
            echo "                                ";
            if (($this->getAttribute($context["user"], "type", array()) == "facebook")) {
                // line 48
                echo "                                    <img class=\"badge-avatar\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/facebook.png"), "html", null, true);
                echo "\" >
                                ";
            } elseif (($this->getAttribute(            // line 49
$context["user"], "type", array()) == "google")) {
                // line 50
                echo "                                    <img class=\"badge-avatar\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/google.png"), "html", null, true);
                echo "\" >
                                ";
            } else {
                // line 52
                echo "                                    <img class=\"badge-avatar\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/mobile.png"), "html", null, true);
                echo "\" >
                                ";
            }
            // line 54
            echo "                                </div>
                              </td>
                              <td>";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "name", array()), "html", null, true);
            echo "</td>
                              <td>";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "username", array()), "html", null, true);
            echo "</td>
                              <td>
                                ";
            // line 59
            if (($this->getAttribute($context["user"], "enabled", array()) == true)) {
                // line 60
                echo "                                  <span class=\"label label-success\">Enabled</span>
                                ";
            } else {
                // line 62
                echo "                                  <span class=\"label label-danger\">Disabled</span>
                                ";
            }
            // line 64
            echo "                              </td>
                              <td>
                                ";
            // line 66
            if (($this->getAttribute($context["user"], "trusted", array()) == true)) {
                // line 67
                echo "                                  <span class=\"label label-success\">Trusted</span>
                                ";
            }
            // line 69
            echo "                              </td>
                              <td>
                                  <a href=\"";
            // line 71
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_user_edit", array("id" => $this->getAttribute($context["user"], "id", array()))), "html", null, true);
            echo "\" rel=\"tooltip\" data-placement=\"left\" class=\" btn btn-primary btn-xs btn-round\" data-original-title=\"View\">
                                        <i class=\"material-icons\">edit</i>
                                    </a>
                              </td>

                          </tr>
                          ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 78
            echo "                      <tr>
                        <td colspan=\"4\">
                          <br>
                          <br>
                          <center><img src=\"";
            // line 82
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/bg_empty.png"), "html", null, true);
            echo "\"  style=\"width: auto !important;\" =\"\"></center>
                            <br>
                            <br>
                        </td>
                      </tr> 
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "                      </tbody>
                  </table>

              </div>
          </div>

        </div>
              <div class=\" pull-right\">
        ";
        // line 96
        echo $this->env->getExtension('Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension')->render($this->env, ($context["pagination"] ?? null));
        echo "
      </div>
      </div>

  </div>
                            






";
    }

    public function getTemplateName()
    {
        return "UserBundle:User:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 96,  186 => 88,  174 => 82,  168 => 78,  156 => 71,  152 => 69,  148 => 67,  146 => 66,  142 => 64,  138 => 62,  134 => 60,  132 => 59,  127 => 57,  123 => 56,  119 => 54,  113 => 52,  107 => 50,  105 => 49,  100 => 48,  97 => 47,  91 => 45,  89 => 44,  84 => 41,  79 => 40,  55 => 19,  48 => 15,  42 => 12,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "UserBundle:User:index.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/UserBundle/Resources/views/User/index.html.twig");
    }
}
