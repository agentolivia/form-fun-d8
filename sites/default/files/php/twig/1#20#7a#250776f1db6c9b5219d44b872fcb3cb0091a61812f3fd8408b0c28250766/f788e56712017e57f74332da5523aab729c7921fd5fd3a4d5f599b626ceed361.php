<?php

/* core/themes/bartik/templates/page.html.twig */
class __TwigTemplate_207a250776f1db6c9b5219d44b872fcb3cb0091a61812f3fd8408b0c28250766 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 78
        echo "<div id=\"page-wrapper\"><div id=\"page\">

  <header id=\"header\" role=\"banner\" aria-label=\"";
        // line 80
        echo twig_render_var(t("Site header"));
        echo "\"><div class=\"section clearfix\">

    ";
        // line 82
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "secondary_menu", array()), "html", null, true);
        echo "

    ";
        // line 84
        if ((isset($context["logo"]) ? $context["logo"] : null)) {
            // line 85
            echo "      <a href=\"";
            echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
            echo "\" title=\"";
            echo twig_render_var(t("Home"));
            echo "\" rel=\"home\" id=\"logo\">
        <img src=\"";
            // line 86
            echo twig_drupal_escape_filter($this->env, (isset($context["logo"]) ? $context["logo"] : null), "html", null, true);
            echo "\" alt=\"";
            echo twig_render_var(t("Home"));
            echo "\" />
      </a>
    ";
        }
        // line 89
        echo "
    ";
        // line 90
        if (((isset($context["site_name"]) ? $context["site_name"] : null) || (isset($context["site_slogan"]) ? $context["site_slogan"] : null))) {
            // line 91
            echo "      <div id=\"name-and-slogan\"";
            if (((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null) && (isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null))) {
                echo " class=\"visually-hidden\"";
            }
            echo ">
        ";
            // line 92
            if ((isset($context["site_name"]) ? $context["site_name"] : null)) {
                // line 93
                echo "          ";
                if ((isset($context["title"]) ? $context["title"] : null)) {
                    // line 94
                    echo "            <div id=\"site-name\"";
                    if ((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null)) {
                        echo " class=\"visually-hidden\"";
                    }
                    echo ">
              <strong>
                <a href=\"";
                    // line 96
                    echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
                    echo "\" title=\"";
                    echo twig_render_var(t("Home"));
                    echo "\" rel=\"home\"><span>";
                    echo twig_drupal_escape_filter($this->env, (isset($context["site_name"]) ? $context["site_name"] : null), "html", null, true);
                    echo "</span></a>
              </strong>
            </div>
          ";
                    // line 100
                    echo "          ";
                } else {
                    // line 101
                    echo "            <h1 id=\"site-name\"";
                    if ((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null)) {
                        echo " class=\"visually-hidden\" ";
                    }
                    echo ">
              <a href=\"";
                    // line 102
                    echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
                    echo "\" title=\"";
                    echo twig_render_var(t("Home"));
                    echo "\" rel=\"home\"><span>";
                    echo twig_drupal_escape_filter($this->env, (isset($context["site_name"]) ? $context["site_name"] : null), "html", null, true);
                    echo "</span></a>
            </h1>
          ";
                }
                // line 105
                echo "        ";
            }
            // line 106
            echo "
        ";
            // line 107
            if ((isset($context["site_slogan"]) ? $context["site_slogan"] : null)) {
                // line 108
                echo "          <div id=\"site-slogan\"";
                if ((isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null)) {
                    echo " class=\"visually-hidden\"";
                }
                echo ">
            ";
                // line 109
                echo twig_drupal_escape_filter($this->env, (isset($context["site_slogan"]) ? $context["site_slogan"] : null), "html", null, true);
                echo "
          </div>
        ";
            }
            // line 112
            echo "      </div><!-- /#name-and-slogan -->
    ";
        }
        // line 114
        echo "
    ";
        // line 115
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "html", null, true);
        echo "
    ";
        // line 116
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "primary_menu", array()), "html", null, true);
        echo "

  </div></header> <!-- /.section, /#header-->

  ";
        // line 120
        if ((isset($context["messages"]) ? $context["messages"] : null)) {
            // line 121
            echo "    <div id=\"messages\"><div class=\"section clearfix\">
      ";
            // line 122
            echo twig_drupal_escape_filter($this->env, (isset($context["messages"]) ? $context["messages"] : null), "html", null, true);
            echo "
    </div></div> <!-- /.section, /#messages -->
  ";
        }
        // line 125
        echo "
  ";
        // line 126
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured", array())) {
            // line 127
            echo "    <aside id=\"featured\"><div class=\"section clearfix\">
      ";
            // line 128
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "featured", array()), "html", null, true);
            echo "
    </div></aside> <!-- /.section, /#featured -->
  ";
        }
        // line 131
        echo "
  <div id=\"main-wrapper\" class=\"clearfix\"><div id=\"main\" class=\"clearfix\">
    ";
        // line 133
        echo twig_drupal_escape_filter($this->env, (isset($context["breadcrumb"]) ? $context["breadcrumb"] : null), "html", null, true);
        echo "

    <main id=\"content\" class=\"column\" role=\"main\"><section class=\"section\">
      ";
        // line 136
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "highlighted", array())) {
            echo "<div id=\"highlighted\">";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "highlighted", array()), "html", null, true);
            echo "</div>";
        }
        // line 137
        echo "      <a id=\"main-content\" tabindex=\"-1\"></a>
      ";
        // line 138
        echo twig_drupal_escape_filter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true);
        echo "
        ";
        // line 139
        if ((isset($context["title"]) ? $context["title"] : null)) {
            // line 140
            echo "          <h1 class=\"title\" id=\"page-title\">
            ";
            // line 141
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "
          </h1>
        ";
        }
        // line 144
        echo "      ";
        echo twig_drupal_escape_filter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true);
        echo "
        ";
        // line 145
        if ((isset($context["tabs"]) ? $context["tabs"] : null)) {
            // line 146
            echo "          <nav class=\"tabs\" role=\"navigation\" aria-label=\"";
            echo twig_render_var(t("Tabs"));
            echo "\">
            ";
            // line 147
            echo twig_drupal_escape_filter($this->env, (isset($context["tabs"]) ? $context["tabs"] : null), "html", null, true);
            echo "
          </nav>
        ";
        }
        // line 150
        echo "      ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "help", array()), "html", null, true);
        echo "
        ";
        // line 151
        if ((isset($context["action_links"]) ? $context["action_links"] : null)) {
            // line 152
            echo "          <ul class=\"action-links\">
            ";
            // line 153
            echo twig_drupal_escape_filter($this->env, (isset($context["action_links"]) ? $context["action_links"] : null), "html", null, true);
            echo "
          </ul>
        ";
        }
        // line 156
        echo "      ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content", array()), "html", null, true);
        echo "
    </section></main> <!-- /.section, /#content -->

    ";
        // line 159
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array())) {
            // line 160
            echo "      <div id=\"sidebar-first\" class=\"column sidebar\"><aside class=\"section\">
        ";
            // line 161
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array()), "html", null, true);
            echo "
      </aside></div><!-- /.section, /#sidebar-first -->
    ";
        }
        // line 164
        echo "
    ";
        // line 165
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array())) {
            // line 166
            echo "      <div id=\"sidebar-second\" class=\"column sidebar\"><aside class=\"section\">
        ";
            // line 167
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array()), "html", null, true);
            echo "
      </aside></div><!-- /.section, /#sidebar-second -->
    ";
        }
        // line 170
        echo "
  </div></div><!-- /#main, /#main-wrapper -->

  ";
        // line 173
        if ((($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_first", array()) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_middle", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_last", array()))) {
            // line 174
            echo "    <div id=\"triptych-wrapper\"><aside id=\"triptych\" class=\"clearfix\">
      ";
            // line 175
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_first", array()), "html", null, true);
            echo "
      ";
            // line 176
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_middle", array()), "html", null, true);
            echo "
      ";
            // line 177
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "triptych_last", array()), "html", null, true);
            echo "
    </aside></div><!-- /#triptych, /#triptych-wrapper -->
  ";
        }
        // line 180
        echo "
  <div id=\"footer-wrapper\"><footer class=\"section\">

    ";
        // line 183
        if (((($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_firstcolumn", array()) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_secondcolumn", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_thirdcolumn", array())) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fourthcolumn", array()))) {
            // line 184
            echo "      <div id=\"footer-columns\" class=\"clearfix\">
        ";
            // line 185
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_firstcolumn", array()), "html", null, true);
            echo "
        ";
            // line 186
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_secondcolumn", array()), "html", null, true);
            echo "
        ";
            // line 187
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_thirdcolumn", array()), "html", null, true);
            echo "
        ";
            // line 188
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer_fourthcolumn", array()), "html", null, true);
            echo "
      </div><!-- /#footer-columns -->
    ";
        }
        // line 191
        echo "
    ";
        // line 192
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer", array())) {
            // line 193
            echo "      <div id=\"footer\" role=\"contentinfo\" class=\"clearfix\">
        ";
            // line 194
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer", array()), "html", null, true);
            echo "
      </div> <!-- /#footer -->
   ";
        }
        // line 197
        echo "
  </footer></div> <!-- /.section, /#footer-wrapper -->

</div></div> <!-- /#page, /#page-wrapper -->
";
    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  335 => 197,  329 => 194,  326 => 193,  324 => 192,  321 => 191,  315 => 188,  311 => 187,  307 => 186,  303 => 185,  300 => 184,  298 => 183,  293 => 180,  287 => 177,  283 => 176,  279 => 175,  276 => 174,  274 => 173,  269 => 170,  263 => 167,  260 => 166,  258 => 165,  255 => 164,  249 => 161,  246 => 160,  244 => 159,  237 => 156,  231 => 153,  228 => 152,  226 => 151,  221 => 150,  215 => 147,  210 => 146,  208 => 145,  203 => 144,  197 => 141,  194 => 140,  192 => 139,  188 => 138,  185 => 137,  179 => 136,  173 => 133,  169 => 131,  163 => 128,  160 => 127,  158 => 126,  155 => 125,  149 => 122,  146 => 121,  144 => 120,  137 => 116,  133 => 115,  130 => 114,  126 => 112,  120 => 109,  113 => 108,  111 => 107,  108 => 106,  105 => 105,  95 => 102,  88 => 101,  85 => 100,  75 => 96,  67 => 94,  64 => 93,  62 => 92,  55 => 91,  53 => 90,  50 => 89,  42 => 86,  35 => 85,  33 => 84,  28 => 82,  23 => 80,  19 => 78,);
    }
}
