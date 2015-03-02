<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Objects\ClassMethodCallNode;
use Pharborist\Functions\FunctionCallNode;

/**
 * @Converter(
 *  id = "field_info_field_types",
 *  description = @Translation("Rewrites calls to field_info_field_types().")
 * )
 */
class FieldInfoFieldTypes extends FunctionCallModifier {

  /**
   * {@inheritdoc}
   */
  public function rewrite(FunctionCallNode $call, TargetInterface $target) {
    $replacement = ClassMethodCallNode::create('\Drupal', 'service')
      ->appendArgument('plugin.manager.field.field_type');

    $arguments = $call->getArguments();
    if ($arguments->isEmpty()) {
      return $replacement->appendMethodCall('getDefinitions');
    }
    elseif (sizeof($arguments) == 1) {
      return $replacement
        ->appendMethodCall('getDefinition')
        ->appendArgument(clone $arguments[0]);
    }
  }

}
