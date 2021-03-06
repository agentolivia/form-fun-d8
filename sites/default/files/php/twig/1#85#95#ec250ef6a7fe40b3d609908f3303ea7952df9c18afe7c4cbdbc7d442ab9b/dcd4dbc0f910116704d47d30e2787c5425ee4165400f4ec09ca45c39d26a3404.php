<?php

/* core/themes/bartik/templates/maintenance-page.html.twig */
class __TwigTemplate_8595ec250ef6a7fe40b3d609908f3303ea7952df9c18afe7c4cbdbc7d442ab9b extends Twig_Template
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
        // line 11
        echo "  <div id=\"page-wrapper\"><div id=\"page\">

    <header id=\"header\" role=\"banner\"><div class=\"section clearfix\">
      ";
        // line 14
        if (((isset($context["site_name"]) ? $context["site_name"] : null) || (isset($context["site_slogan"]) ? $context["site_slogan"] : null))) {
            // line 15
            echo "        <div id=\"name-and-slogan\"";
            echo twig_render_var(((((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null) && (isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null))) ? (" class=\"visually-hidden\"") : ("")));
            echo ">
          ";
            // line 16
            if ((isset($context["site_name"]) ? $context["site_name"] : null)) {
                // line 17
                echo "            <div id=\"site-name\"";
                echo twig_render_var((((isset($context["hide_site_name"]) ? $context["hide_site_name"] : null)) ? (" class=\"visually-hidden\"") : ("")));
                echo ">
              <strong>
                <a href=\"";
                // line 19
                echo twig_drupal_escape_filter($this->env, (isset($context["front_page"]) ? $context["front_page"] : null), "html", null, true);
                echo "\" title=\"";
                echo twig_render_var(t("Home"));
                echo "\" rel=\"home\"><span>";
                echo twig_drupal_escape_filter($this->env, (isset($context["site_name"]) ? $context["site_name"] : null), "html", null, true);
                echo "</span></a>
              </strong>
            </div>
          ";
            }
            // line 23
            echo "          ";
            if ((isset($context["site_slogan"]) ? $context["site_slogan"] : null)) {
                // line 24
                echo "            <div id=\"site-slogan\"";
                echo twig_render_var((((isset($context["hide_site_slogan"]) ? $context["hide_site_slogan"] : null)) ? (" class=\"visually-hidden\"") : ("")));
                echo ">
              ";
                // line 25
                echo twig_drupal_escape_filter($this->env, (isset($context["site_slogan"]) ? $context["site_slogan"] : null), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 28
            echo "        </div> <!-- /#name-and-slogan -->
      ";
        }
        // line 30
        echo "    </div></header> <!-- /.section, /#header -->

    <div id=\"main-wrapper\"><div id=\"main\" class=\"clearfix\">
      <main id=\"content\" class=\"column\" role=\"main\"><section class=\"section\">
        <a id=\"main-content\"></a>
        ";
        // line 35
        if ((isset($context["title"]) ? $context["title"] : null)) {
            echo "<h1 class=\"title\" id=\"page-title\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
            echo "</h1>";
        }
        // line 36
        echo "        ";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content", array()), "html", null, true);
        echo "
        ";
        // line 37
        if ((isset($context["messages"]) ? $context["messages"] : null)) {
            // line 38
            echo "          <div id=\"messages\"><div class=\"section clearfix\">
            ";
            // line 39
            echo twig_drupal_escape_filter($this->env, (isset($context["messages"]) ? $context["messages"] : null), "html", null, true);
            echo "
          </div></div> <!-- /.section, /#messages -->
        ";
        }
        // line 42
        echo "      </section></main> <!-- /.section, /#content -->
    </div></div> <!-- /#main, /#main-wrapper -->

  </div></div> <!-- /#page, /#page-wrapper -->
";
    }

    public function getTemplateName()
    {
        return "core/themes/bartik/templates/maintenance-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 42,  91 => 39,  88 => 38,  86 => 37,  81 => 36,  75 => 35,  68 => 30,  64 => 28,  58 => 25,  53 => 24,  50 => 23,  39 => 19,  33 => 17,  31 => 16,  26 => 15,  24 => 14,  19 => 11,);
    }
}
