<?php

/* core/modules/system/templates/image.html.twig */
class __TwigTemplate_6b775a20a9e1c57aba9c6101ab32937c77423509b7c3159918ea477e27d7867e extends Twig_Template
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
        // line 16
        $context["classes"] = array(0 => (((isset($context["style_name"]) ? $context["style_name"] : null)) ? (("image-style-" . drupal_html_class((isset($context["style_name"]) ? $context["style_name"] : null)))) : ("")));
        // line 20
        echo "<img";
        echo twig_drupal_escape_filter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true);
        echo " />
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 20,  19 => 16,);
    }
}
