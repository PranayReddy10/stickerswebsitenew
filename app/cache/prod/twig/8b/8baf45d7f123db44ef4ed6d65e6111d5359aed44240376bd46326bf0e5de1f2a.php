<?php

/* AppBundle:Pack:add.html.twig */
class __TwigTemplate_827aca12e1d04b250eb117e8cb71c3cabe1ffadc4f616ef9889cd48e1b07a138 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Pack:add.html.twig", 1);
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
        echo "  <div class=\"container-fluid\">
    <div class=\"row\">
      <div class=\"col-sm-offset-1 col-md-10\">
        <div class=\"card\">
          <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
            <i class=\"material-icons\">inbox</i>
          </div>
          <div class=\"card-content\">
            <h4 class=\"card-title\">New Pack</h4>
            ";
        // line 12
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_start');
        echo "
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Pack name</label>
              ";
        // line 15
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "name", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 16
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "name", array()), 'errors');
        echo "</span>
            </div>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Pack publisher</label>
              ";
        // line 20
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisher", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 21
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisher", array()), 'errors');
        echo "</span>
            </div>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Publisher E-mail</label>
              ";
        // line 25
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisheremail", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 26
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisheremail", array()), 'errors');
        echo "</span>
            </div>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Publisher Website</label>
              ";
        // line 30
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisherwebsite", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisherwebsite", array()), 'errors');
        echo "</span>
            </div>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Website privacy policy</label>
              ";
        // line 35
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "privacypolicywebsite", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 36
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "privacypolicywebsite", array()), 'errors');
        echo "</span>
            </div>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Website license agreement</label>
              ";
        // line 40
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "licenseagreementwebsite", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
              <span class=\"validate-input\">";
        // line 41
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "licenseagreementwebsite", array()), 'errors');
        echo "</span>
            </div>
            <br>
            <div class=\"panel-body\">
              <label class=\"panel-title\">Pack infos</label>
              <div class=\"\">
                <label>
                  ";
        // line 48
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "enabled", array()), 'widget');
        echo "  Enabled
                </label>
              </div>
              <div class=\"\">
                <label>
                  ";
        // line 53
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "premium", array()), 'widget');
        echo "  Premium Pack
                </label>
              </div>
              <div class=\"\">
                <label>
                  ";
        // line 58
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "animated", array()), 'widget');
        echo "  Animated
                </label>
              </div>
                            <div class=\"\">
                <label>
                  ";
        // line 63
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "whatsapp", array()), 'widget');
        echo "  Enable whatsapp Button
                </label>

                </div>
            </div>
            <div class=\"panel-body\">
              <label class=\"panel-title\">Telegram</label>
              <div class=\"\">
                <label>
                  ";
        // line 72
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "telegram", array()), 'widget');
        echo "  Enabled
                </label>
              </div>
              <div class=\"form-group label-floating \">
                <label class=\"control-label\">Telegram store pack url</label>
                ";
        // line 77
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "telegramurl", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                <span class=\"validate-input\">";
        // line 78
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "telegramurl", array()), 'errors');
        echo "</span>
              </div>
            </div>
            <div class=\"panel-body\">
              <label class=\"panel-title\">Signal</label>
              <div class=\"\">
                <label>
                  ";
        // line 85
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "signal", array()), 'widget');
        echo "  Enabled Signal Button
                </label>
              </div>
              <div class=\"form-group label-floating \">
                <label class=\"control-label\">Signal store pack url</label>
                ";
        // line 90
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "signalurl", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                <span class=\"validate-input\">";
        // line 91
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "signalurl", array()), 'errors');
        echo "</span>
              </div>
            </div>
            <br>
            ";
        // line 95
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "categories", array()), 'label', array("label_attr" => array("style" => "font-size:16px")));
        echo " :
            <div>
              <div class=\"row\">
                ";
        // line 98
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["form"] ?? null), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 99
            echo "                  <label  style=\"background: black;border-radius: 3px;padding: 5px;text-align: center;margin: 10px;color: white;font-weight: bold;padding-left: 20px;padding-right: 20px;\">
                    ";
            // line 100
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($context["field"], 'widget');
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["field"], "vars", array()), "label", array()), "html", null, true);
            echo "
                  </label>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "              </div>
            </div>
            <br>
            <div class=\"form-group label-floating \">
              <label class=\"control-label\">Pack tags (Ex:anim,art,hero)</label>
              <br>
              ";
        // line 109
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "tags", array()), 'widget', array("attr" => array("class" => "input-tags")));
        echo "
              <span class=\"validate-input\">";
        // line 110
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "tags", array()), 'errors');
        echo "</span>
            </div>
            <script>
            \$('.input-tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
            });
            </script>
            <br>
            <div class=\"pack-files\">
              <div class=\"pack-image\">
                <div class=\"path-image-img\"><img src=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/image_placeholder.jpg"), "html", null, true);
        echo "\" class=\"thumbnail\" id=\"img-preview\"></div>
                <button class=\"btn-select\">select pack image</button>
                <div class=\"form-group label-floating is-input-file\">
                  ";
        // line 125
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "file", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                </div>
              </div>
              <div class=\"pack-stickers\">
                <div class=\"pack-stickers-files\"></div>
                <button class=\"btn-select-stickers\">select stickers files (PNG/WEBP files)</button>
                <div class=\"form-group label-floating is-input-file\">
                  ";
        // line 132
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "files", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                </div>
              </div>
            </div>
            <span class=\"validate-input\">";
        // line 136
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "files", array()), 'errors');
        echo "</span>
            <span class=\"validate-input\">";
        // line 137
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "file", array()), 'errors');
        echo "</span>
            <span class=\"pull-right\"><a href=\"";
        // line 138
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\" class=\"btn btn-fill btn-yellow\"><i class=\"material-icons\">arrow_back</i> Cancel</a>";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "save", array()), 'widget', array("attr" => array("class" => "btn btn-fill btn-rose")));
        echo "</span>
            ";
        // line 139
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_end');
        echo "
          </div>
        </div>
      </div>
    </div>
  </div>
";
    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 139,  276 => 138,  272 => 137,  268 => 136,  261 => 132,  251 => 125,  245 => 122,  230 => 110,  226 => 109,  218 => 103,  207 => 100,  204 => 99,  200 => 98,  194 => 95,  187 => 91,  183 => 90,  175 => 85,  165 => 78,  161 => 77,  153 => 72,  141 => 63,  133 => 58,  125 => 53,  117 => 48,  107 => 41,  103 => 40,  96 => 36,  92 => 35,  85 => 31,  81 => 30,  74 => 26,  70 => 25,  63 => 21,  59 => 20,  52 => 16,  48 => 15,  42 => 12,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Pack:add.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/add.html.twig");
    }
}
