<?php

/* core/modules/system/templates/fieldset.html.twig */
class __TwigTemplate_92e92999b81451182a5bb26526cbac27f9d29e3f8ade3f9d933b621d484a0237 extends Twig_Template
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
        // line 24
        echo "<fieldset";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => "form-item", 1 => "form-wrapper"), "method"), "html", null, true);
        echo ">
  ";
        // line 26
        $context["legend_span_classes"] = array(0 => "fieldset-legend", 1 => (((isset($context["required"]) ? $context["required"] : null)) ? ("form-required") : ("")));
        // line 31
        echo "  ";
        // line 32
        echo "  <legend";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["legend"]) ? $context["legend"] : null), "attributes", array()), "html", null, true);
        echo ">
    <span";
        // line 33
        echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["legend_span"]) ? $context["legend_span"] : null), "attributes", array()), "addClass", array(0 => (isset($context["legend_span_classes"]) ? $context["legend_span_classes"] : null)), "method"), "html", null, true);
        echo ">";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["legend"]) ? $context["legend"] : null), "title", array()), "html", null, true);
        echo "</span>
  </legend>
  <div class=\"fieldset-wrapper\">
    ";
        // line 36
        if ((isset($context["prefix"]) ? $context["prefix"] : null)) {
            // line 37
            echo "      <span class=\"field-prefix\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["prefix"]) ? $context["prefix"] : null), "html", null, true);
            echo "</span>
    ";
        }
        // line 39
        echo "    ";
        echo twig_drupal_escape_filter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true);
        echo "
    ";
        // line 40
        if ((isset($context["suffix"]) ? $context["suffix"] : null)) {
            // line 41
            echo "      <span class=\"field-suffix\">";
            echo twig_drupal_escape_filter($this->env, (isset($context["suffix"]) ? $context["suffix"] : null), "html", null, true);
            echo "</span>
    ";
        }
        // line 43
        echo "    ";
        if ($this->getAttribute((isset($context["description"]) ? $context["description"] : null), "content", array())) {
            // line 44
            echo "      <div";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["description"]) ? $context["description"] : null), "attributes", array()), "addClass", array(0 => "description"), "method"), "html", null, true);
            echo ">";
            echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["description"]) ? $context["description"] : null), "content", array()), "html", null, true);
            echo "</div>
    ";
        }
        // line 46
        echo "  </div>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/fieldset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 46,  65 => 44,  62 => 43,  56 => 41,  54 => 40,  49 => 39,  43 => 37,  41 => 36,  33 => 33,  28 => 32,  26 => 31,  24 => 26,  19 => 24,);
    }
}
