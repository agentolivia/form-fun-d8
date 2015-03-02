<?php

/* core/modules/system/templates/admin-page.html.twig */
class __TwigTemplate_91bdd44d9c3171d570c35f3fe955312e95ff8539d46dca5551e5bca7936785c9 extends Twig_Template
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
        // line 17
        echo "<div class=\"admin clearfix\">
  ";
        // line 18
        echo twig_drupal_escape_filter($this->env, (isset($context["system_compact_link"]) ? $context["system_compact_link"] : null), "html", null, true);
        echo "
  ";
        // line 19
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["containers"]) ? $context["containers"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["container"]) {
            // line 20
            echo "    <div class=\"layout-column half clearfix\">
      ";
            // line 21
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["container"], "blocks", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 22
                echo "        ";
                echo twig_drupal_escape_filter($this->env, $context["block"], "html", null, true);
                echo "
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['container'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/modules/system/templates/admin-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 26,  46 => 24,  37 => 22,  33 => 21,  30 => 20,  26 => 19,  22 => 18,  19 => 17,);
    }
}
