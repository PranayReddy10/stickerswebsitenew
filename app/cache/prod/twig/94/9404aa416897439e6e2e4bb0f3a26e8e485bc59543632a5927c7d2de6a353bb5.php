<?php

/* AppBundle:Pack:view.html.twig */
class __TwigTemplate_39e763a0215eead0c6de68434ae2115145c4bb615f0eaeaf7e790276ab5a5000 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::layout.html.twig", "AppBundle:Pack:view.html.twig", 1);
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
            <div class=\"row\">
                <div class=\"col-md-4\">
                    <a href=\"";
        // line 7
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_index");
        echo "\" class=\"btn btn-rose btn-lg pull-right add-button col-md-12\" title=\"\"><i class=\"material-icons\" style=\"font-size: 30px;\">arrow_back</i> PACK LIST </a>
                </div>
                <div class=\"col-md-4\">
                    <a class=\"btn btn btn-lg btn-yellow col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">inbox</i> ";
        // line 10
        echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
        echo " Sticker(s)</a>
                </div>
                <div class=\"col-md-4\">
                    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_pack_stickers", array("id" => $this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "get", array(0 => "id"), "method"))), "html", null, true);
        echo "\" class=\"btn  btn-lg btn-warning col-md-12\"><i class=\"material-icons\" style=\"font-size: 30px;\">refresh</i> Refresh</a>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"card\">
                        <div class=\"card-header card-header-icon\" data-background-color=\"rose\">
                            <i class=\"material-icons\">inbox</i>
                        </div>
                        <div class=\"card-content\">
                            <h4 class=\"card-title\">";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "name", array()), "html", null, true);
        echo " stickers  <span class=\"label label-danger label-lg pull-right\" style=\"font-size:14px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "sizes", array()), "html", null, true);
        echo "</span></h4>
                            <br>
                            <br>
                            <div>
                                <div class=\"pack-image\" style=\"    margin-top: 12px;\">
                                    <div class=\"path-image-img\"><img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Liip\ImagineBundle\Templating\ImagineExtension')->filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute(($context["pack"] ?? null), "image", array()), "link", array())), "sticker_image"), "html", null, true);
        echo "\" class=\"thumbnail\" id=\"img-preview\"><img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Liip\ImagineBundle\Templating\ImagineExtension')->filter($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute(($context["pack"] ?? null), "image", array()), "link", array())), "tray_image"), "html", null, true);
        echo "\" style=\"display:none\"></div>
                                </div>
                                <div class=\"form-right-view\">
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Pack name</label>
                                        <input name=\"name\" class=\"form-control\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "name", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Pack publisher</label>
                                        <input name=\"publisher\" class=\"form-control\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisher", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Publisher E-mail</label>
                                        <input name=\"name\" class=\"form-control\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisheremail", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Publisher Website</label>
                                        <input name=\"publisher\" class=\"form-control\" value=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "publisherwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                            </div>
                            <div class=\"col-md-6\">
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Website privacy policy</label>
                                        <input name=\"name\" class=\"form-control\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "privacypolicywebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                                    <div class=\"form-group label-floating \">
                                        <label class=\"control-label\">Website license agreement</label>
                                        <input name=\"publisher\" class=\"form-control\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute(($context["pack"] ?? null), "licenseagreementwebsite", array()), "html", null, true);
        echo "\" readonly=\"true\">
                                    </div>
                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 63
        if ($this->getAttribute(($context["pack"] ?? null), "enabled", array())) {
            // line 64
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled</span>
                                ";
        } else {
            // line 66
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled</span>
                                ";
        }
        // line 68
        echo "                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 71
        if ($this->getAttribute(($context["pack"] ?? null), "premium", array())) {
            // line 72
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Premium Pack</span>
                                ";
        } else {
            // line 74
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Free Pack</span>
                                ";
        }
        // line 76
        echo "                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 79
        if ($this->getAttribute(($context["pack"] ?? null), "animated", array())) {
            // line 80
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Animated Pack</span>
                                ";
        } else {
            // line 82
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Static Pack</span>
                                ";
        }
        // line 84
        echo "                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 87
        if ($this->getAttribute(($context["pack"] ?? null), "whatsapp", array())) {
            // line 88
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled for Whatsapp</span>
                                ";
        } else {
            // line 90
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled for Whatsapp</span>
                                ";
        }
        // line 92
        echo "                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 95
        if ($this->getAttribute(($context["pack"] ?? null), "telegram", array())) {
            // line 96
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled Telegram</span>
                                ";
        } else {
            // line 98
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled for Telegram</span>
                                ";
        }
        // line 100
        echo "                            </div>
                            <div class=\"col-md-4\">
                                <br>
                                ";
        // line 103
        if ($this->getAttribute(($context["pack"] ?? null), "signal", array())) {
            // line 104
            echo "                                    <i class=\"material-icons\" style=\"color:green;float:left\">check_circle</i> <span class=\"check-label\">Enabled for Signal</span>
                                ";
        } else {
            // line 106
            echo "                                    <i class=\"material-icons\" style=\"color:red;float:left\">cancel</i> <span class=\"check-label\">Disabled for Signal</span>
                                ";
        }
        // line 108
        echo "                            </div>
                            <div class=\"col-md-6\">
                                <h4>Categories : </h4>
                                ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? null), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 112
            echo "                                    <span class=\"label label-rose \" style=\"margin:5px;\"> <b> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "title", array()), "html", null, true);
            echo " </b></span>  
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "                                <br>
                                <br>
                                <br>
                            </div>
                            <div class=\"col-md-6\" >
                                <h4>Tags : </h4>
                                ";
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["pack"] ?? null), "tagslist", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 121
            echo "                                    <span class=\"label label-rose \" style=\"margin:5px;\"> <b> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
            echo " </b></span>  
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 123
        echo "                                <br>
                                <br>
                                <br>
                            </div>  
                            <hr>
                            <div class=\"card-footer\">
                                <div class=\"wallpaper-logo\" >
                                    ";
        // line 130
        if (($this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "image", array()) == "")) {
            // line 131
            echo "                                        ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "name", array()), "html", null, true);
            echo "
                                    ";
        } else {
            // line 133
            echo "                                        <img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "image", array()), "html", null, true);
            echo "\" class=\"avatar-img\" alt=\"\"> 
                                    ";
        }
        // line 135
        echo "                                    <span style=\"    line-height: 26px;font-size: 16px;\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["pack"] ?? null), "user", array()), "name", array()), "html", null, true);
        echo "</span>
                                    <span style=\"    line-height: 26px;font-size: 16px;\">|</span>
                                    <span style=\"    line-height: 26px;font-size: 16px;\">";
        // line 137
        echo $this->env->getExtension('Knp\Bundle\TimeBundle\Twig\Extension\TimeExtension')->diff($this->getAttribute(($context["pack"] ?? null), "created", array()));
        echo "</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"card\" >
                    <div class=\"status-bar\"></div>
                    <div class=\"action-bar\">
                        <a href=\"#\" class=\"zmdi zmdi-star\"></a>
                    </div>
                    ";
        // line 151
        $context["rate"] = ($context["rating"] ?? null);
        // line 152
        echo "                    ";
        $context["rate_main"] = ($context["rating"] ?? null);
        // line 153
        echo "                    <div class=\"list-group lg-alt lg-even-black\">
                        <br>
                        <center>
                        </center>
                        <table width=\"100%\" >
                            <tr>
                                <td colspan=\"2\" style=\"padding: 15px;\" align=\"right\">
                                    <div style=\"/* float: left; */display: inline-flex;\">
                                        ";
        // line 161
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 162
            echo "                                            ";
            if ((($context["rate"] ?? null) >= 1)) {
                // line 163
                echo "                                                <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
                echo "\" style=\"height:50px;width:50px\">
                                            ";
            }
            // line 165
            echo "                                            ";
            if (((($context["rate"] ?? null) >= 0.25) && (($context["rate"] ?? null) < 0.75))) {
                // line 166
                echo "                                                <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_h.png"), "html", null, true);
                echo "\" style=\"height:50px;width:50px\">
                                            ";
            }
            // line 168
            echo "                                            ";
            if (((($context["rate"] ?? null) >= 0.75) && (($context["rate"] ?? null) < 1))) {
                // line 169
                echo "                                                <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
                echo "\" style=\"height:50px;width:50px\">
                                            ";
            }
            // line 171
            echo "                                            ";
            if ((($context["rate"] ?? null) < 0.25)) {
                // line 172
                echo "                                                <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
                echo "\" style=\"height:50px;width:50px\">
                                            ";
            }
            // line 174
            echo "                                            ";
            $context["rate"] = (($context["rate"] ?? null) - 1);
            // line 175
            echo "                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 176
        echo "                                    </div>

                                </td>
                                <td>
                                    <span style=\"height: 28px;display: inline-block;font-size: 30pt;font-weight: bold;padding-left: 20px;\">Rating : ";
        // line 180
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($context["rate_main"] ?? null), 1, ".", ","), "html", null, true);
        echo "</span>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"50%\" align=\"right\" style=\"padding: 5px;\">
                                    <img src=\"";
        // line 185
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 186
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 187
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 188
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 189
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                </td>
                                <td width=\"30px\" align=\"center\">";
        // line 191
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ratings"] ?? null), "rate_5", array()), "html", null, true);
        echo "</td>
                                <td  align=\"left\" style=\"padding:10px\">
                                    <span style=\"display:block;height:15px;background-color:#ea1f62;width:";
        // line 193
        echo twig_escape_filter($this->env, $this->getAttribute(($context["values"] ?? null), "rate_5", array()), "html", null, true);
        echo "%\"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"50%\" align=\"right\" style=\"padding: 5px;\">
                                    <img src=\"";
        // line 198
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 199
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 200
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 201
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 202
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                </td>
                                <td width=\"30px\" align=\"center\">";
        // line 204
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ratings"] ?? null), "rate_4", array()), "html", null, true);
        echo "</td>
                                <td  align=\"left\" style=\"padding:10px\">
                                    <span style=\"display:block;height:15px;background-color:#ea1f62;width:";
        // line 206
        echo twig_escape_filter($this->env, $this->getAttribute(($context["values"] ?? null), "rate_4", array()), "html", null, true);
        echo "%\"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"50%\" align=\"right\" style=\"padding: 5px;\">
                                    <img src=\"";
        // line 211
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 212
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 213
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 215
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                </td>
                                <td width=\"30px\" align=\"center\">";
        // line 217
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ratings"] ?? null), "rate_3", array()), "html", null, true);
        echo "</td>
                                <td  align=\"left\" style=\"padding:10px\">
                                    <span style=\"display:block;height:15px;background-color:#ea1f62;width:";
        // line 219
        echo twig_escape_filter($this->env, $this->getAttribute(($context["values"] ?? null), "rate_3", array()), "html", null, true);
        echo "%\"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"50%\" align=\"right\" style=\"padding: 5px;\">
                                    
                                    <img src=\"";
        // line 225
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 226
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 227
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 228
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 229
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                </td>
                                <td width=\"30px\" align=\"center\">";
        // line 231
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ratings"] ?? null), "rate_2", array()), "html", null, true);
        echo "</td>
                                <td  align=\"left\" style=\"padding:10px\">
                                    <span style=\"display:block;height:15px;background-color:#ea1f62;width:";
        // line 233
        echo twig_escape_filter($this->env, $this->getAttribute(($context["values"] ?? null), "rate_2", array()), "html", null, true);
        echo "%\"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"50%\" align=\"right\" style=\"padding: 5px;\">
                                    <img src=\"";
        // line 238
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 239
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 240
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 241
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star_e.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                    <img src=\"";
        // line 242
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("img/star.png"), "html", null, true);
        echo "\" style=\"height:30px;width:30px\">
                                </td>
                                <td width=\"30px\" align=\"center\">";
        // line 244
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ratings"] ?? null), "rate_1", array()), "html", null, true);
        echo "</td>
                                <td  align=\"left\" style=\"padding:10px\">
                                    <span style=\"display:block;height:15px;background-color:#ea1f62;width:";
        // line 246
        echo twig_escape_filter($this->env, $this->getAttribute(($context["values"] ?? null), "rate_1", array()), "html", null, true);
        echo "%\"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class=\"row\">
                ";
        // line 255
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stickers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sticker"]) {
            // line 256
            echo "                    <div class=\"col-md-3\">
                        <div class=\"card\">
                            <div class=\"card-content\">
                                <h3></h3>
                                <img src=\"";
            // line 260
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl($this->getAttribute($this->getAttribute($context["sticker"], "media", array()), "link", array())), "html", null, true);
            echo "\" style=\"width:100%; height:auto;    border-radius: 5px;border:1px solid #ccc;padding:10px\" >
                                <br>
                            </div>
                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sticker'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 266
        echo "            </div>
        </div>
    </div>
    ";
    }

    public function getTemplateName()
    {
        return "AppBundle:Pack:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  575 => 266,  563 => 260,  557 => 256,  553 => 255,  541 => 246,  536 => 244,  531 => 242,  527 => 241,  523 => 240,  519 => 239,  515 => 238,  507 => 233,  502 => 231,  497 => 229,  493 => 228,  489 => 227,  485 => 226,  481 => 225,  472 => 219,  467 => 217,  462 => 215,  458 => 214,  454 => 213,  450 => 212,  446 => 211,  438 => 206,  433 => 204,  428 => 202,  424 => 201,  420 => 200,  416 => 199,  412 => 198,  404 => 193,  399 => 191,  394 => 189,  390 => 188,  386 => 187,  382 => 186,  378 => 185,  370 => 180,  364 => 176,  358 => 175,  355 => 174,  349 => 172,  346 => 171,  340 => 169,  337 => 168,  331 => 166,  328 => 165,  322 => 163,  319 => 162,  315 => 161,  305 => 153,  302 => 152,  300 => 151,  283 => 137,  277 => 135,  271 => 133,  265 => 131,  263 => 130,  254 => 123,  245 => 121,  241 => 120,  233 => 114,  224 => 112,  220 => 111,  215 => 108,  211 => 106,  207 => 104,  205 => 103,  200 => 100,  196 => 98,  192 => 96,  190 => 95,  185 => 92,  181 => 90,  177 => 88,  175 => 87,  170 => 84,  166 => 82,  162 => 80,  160 => 79,  155 => 76,  151 => 74,  147 => 72,  145 => 71,  140 => 68,  136 => 66,  132 => 64,  130 => 63,  122 => 58,  115 => 54,  106 => 48,  99 => 44,  89 => 37,  82 => 33,  72 => 28,  62 => 23,  49 => 13,  43 => 10,  37 => 7,  31 => 3,  28 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:Pack:view.html.twig", "/home/u482908474/domains/gokulstickers.in/public_html/kk/src/AppBundle/Resources/views/Pack/view.html.twig");
    }
}
