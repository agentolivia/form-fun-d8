<?php

/* core/modules/system/templates/system-themes-page.html.twig */
class __TwigTemplate_43d62a7f4c3432a2216fd0de85fe4d06e11f6a056f7ee51a1e3b90d3d72b0bf1 extends Twig_Template
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
        // line 33
        echo "<div";
        echo twig_drupal_escape_filter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true);
        echo ">
  ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["theme_groups"]) ? $context["theme_groups"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["theme_group"]) {
            // line 35
            echo "    ";
            // line 36
            $context["theme_group_classes"] = array(0 => "system-themes-list", 1 => ("system-themes-list-" . $this->getAttribute($context["theme_group"], "state", array())), 2 => "clearfix");
            // line 42
            echo "    <div";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["theme_group"], "attributes", array()), "addClass", array(0 => (isset($context["theme_group_classes"]) ? $context["theme_group_classes"] : null)), "method"), "html", null, true);
            echo ">
      <h2>";
            // line 43
            echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme_group"], "title", array()), "html", null, true);
            echo "</h2>
      ";
            // line 44
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["theme_group"], "themes", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["theme"]) {
                // line 45
                echo "        ";
                // line 46
                $context["theme_classes"] = array(0 => (($this->getAttribute($context["theme"], "is_default", array())) ? ("theme-default") : ("")), 1 => (($this->getAttribute($context["theme"], "is_admin", array())) ? ("theme-admin") : ("")), 2 => "theme-selector", 3 => "clearfix");
                // line 53
                echo "        <div";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["theme"], "attributes", array()), "addClass", array(0 => (isset($context["theme_classes"]) ? $context["theme_classes"] : null)), "method"), "html", null, true);
                echo ">
          ";
                // line 54
                if ($this->getAttribute($context["theme"], "screenshot", array())) {
                    // line 55
                    echo "            ";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "screenshot", array()), "html", null, true);
                    echo "
          ";
                }
                // line 57
                echo "          <div class=\"theme-info\">
            <h3>";
                // line 59
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "name", array()), "html", null, true);
                echo " ";
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "version", array()), "html", null, true);
                // line 60
                if ($this->getAttribute($context["theme"], "notes", array())) {
                    // line 61
                    echo "                (";
                    echo twig_render_var(twig_drupal_join_filter($this->getAttribute($context["theme"], "notes", array()), ", "));
                    echo ")";
                }
                // line 63
                echo "</h3>
            <div class=\"theme-description\">";
                // line 64
                echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "description", array()), "html", null, true);
                echo "</div>
            ";
                // line 66
                echo "            ";
                if ($this->getAttribute($context["theme"], "incompatible", array())) {
                    // line 67
                    echo "              <div class=\"incompatible\">";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "incompatible", array()), "html", null, true);
                    echo "</div>
            ";
                } else {
                    // line 69
                    echo "              ";
                    echo twig_drupal_escape_filter($this->env, $this->getAttribute($context["theme"], "operations", array()), "html", null, true);
                    echo "
            ";
                }
                // line 71
                echo "          </div>
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['theme_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/system-themes-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 76,  106 => 74,  98 => 71,  92 => 69,  86 => 67,  83 => 66,  79 => 64,  76 => 63,  71 => 61,  69 => 60,  65 => 59,  62 => 57,  56 => 55,  54 => 54,  49 => 53,  47 => 46,  45 => 45,  41 => 44,  37 => 43,  32 => 42,  30 => 36,  28 => 35,  24 => 34,  19 => 33,);
    }
}
