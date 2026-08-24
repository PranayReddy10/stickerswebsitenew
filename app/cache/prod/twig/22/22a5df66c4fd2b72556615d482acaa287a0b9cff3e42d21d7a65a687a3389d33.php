<?php

/* AppBundle:Home:ads.html.twig */
class __TwigTemplate_e27e74efd6c0af3c53a31db063d0d89a43c74f4a77cfd12ebad77fec9667506d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Home:ads.html.twig", 1);
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
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-md-3\">
                <div class=\"card\">
                    <div class=\"tab-moivie\">
                        <a href=\"";
        // line 8
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_settings");
        echo "\" class=\"btn btn-tab-movie col-md-12\"><i class=\"material-icons\">settings</i> Settings</a>
                        <a href=\"";
        // line 9
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_home_ads");
        echo "\" class=\"btn btn-tab-movie-active col-md-12\"><i class=\"material-icons\">monetization_on</i> Ads Settings</a>
                        <a href=\"";
        // line 10
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_change_password");
        echo "\" class=\"btn btn-tab-movie col-md-12\"><i class=\"material-icons\">lock</i> Change password</a>
                    </div>
                </div>
            </div>

            <div class=\"col-md-9\">
                <div class=\"card\">
                    <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                        <i class=\"material-icons\">monetization_on</i>
                    </div>
                    <div class=\"card-content\">
                        <h4 class=\"card-title\">Ads Settings</h4>
                        ";
        // line 22
        echo         $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->renderBlock(($context["form"] ?? null), 'form_start');
        echo "
                            <div class=\"panel-body\">
                            <label class=\"panel-title\">AdMob Settings</label>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">AdMob Publisher Id</label>
                                ";
        // line 27
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisherid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 29
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "publisherid", array()), 'errors');
        echo "</span>

                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">AdMob App Id</label>
                                ";
        // line 33
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 35
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "appid", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"panel-body\">
                            <label class=\"panel-title\">Ad Rewarded</label>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Rewarded Id</label>
                                ";
        // line 41
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "rewardedadmobid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 43
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "rewardedadmobid", array()), 'errors');
        echo "</span>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Banner Display Type</label>
                                ";
        // line 46
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "bannerfacebookid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 48
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "bannerfacebookid", array()), 'errors');
        echo "</span>
                        </div>

                        <div class=\"panel-body\">
                            <label class=\"panel-title\">Ad Banner</label>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Banner Id</label>
                                ";
        // line 55
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "banneradmobid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 57
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "banneradmobid", array()), 'errors');
        echo "</span>

                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Banner Display Type</label>
                                ";
        // line 61
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "bannertype", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 63
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "bannertype", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"panel-body\">
                            <label class=\"panel-title\">Ad Interstitial</label>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Interstitial Id</label>
                                ";
        // line 69
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialadmobid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialadmobid", array()), 'errors');
        echo "</span>

                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Interstitial Display Type</label>
                                ";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialtype", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 77
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialtype", array()), 'errors');
        echo "</span>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Click between interstitial Ad</label>
                                ";
        // line 80
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialclick", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 82
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "interstitialclick", array()), 'errors');
        echo "</span>
                        </div>
                        <div class=\"panel-body\">
                            <label class=\"panel-title\">Ad Native</label>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Native Id</label>
                                ";
        // line 88
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativeadmobid", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 90
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativeadmobid", array()), 'errors');
        echo "</span>

                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Native Display Type</label>
                                ";
        // line 94
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativetype", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 96
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativetype", array()), 'errors');
        echo "</span>
                            <div class=\"form-group label-floating is-empty\">
                                <label class=\"control-label\">Items between Native Ads</label>
                                ";
        // line 99
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativeitem", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                            </div>
                            <span class=\"validate-input\">";
        // line 101
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "nativeitem", array()), 'errors');
        echo "</span>
                        </div>
                                                <span class=\"pull-right\"><a href=\"";
        // line 103
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_category_index");
        echo "\" class=\"btn btn-fill btn-yellow\"><i class=\"material-icons\">arrow_back</i> Cancel</a>";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute(($context["form"] ?? null), "save", array()), 'widget', array("attr" => array("class" => "btn btn-fill btn-rose")));
        echo "</span>

                    </div>
                    ";
        // line 106
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
        return "AppBundle:Home:ads.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 106,  217 => 103,  212 => 101,  207 => 99,  201 => 96,  196 => 94,  189 => 90,  184 => 88,  175 => 82,  170 => 80,  164 => 77,  159 => 75,  152 => 71,  147 => 69,  138 => 63,  133 => 61,  126 => 57,  121 => 55,  111 => 48,  106 => 46,  100 => 43,  95 => 41,  86 => 35,  81 => 33,  74 => 29,  69 => 27,  61 => 22,  46 => 10,  42 => 9,  38 => 8,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Home:ads.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Home/ads.html.twig");
    }
}
