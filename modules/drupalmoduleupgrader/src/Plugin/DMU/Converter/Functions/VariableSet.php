<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Objects\ClassMethodCallNode;
use Pharborist\Functions\FunctionCallNode;

/**
 * @Converter(
 *  id = "variable_set",
 *  description = @Translation("Replaces variable_set() calls with Configuration API.")
 * )
 */
class VariableSet extends VariableAPI {

  /**
   * {@inheritdoc}
   */
  public function rewrite(FunctionCallNode $call, TargetInterface $target) {
    if ($this->tryRewrite($call, $target)) {
      $arguments = $call->getArguments();

      return ClassMethodCallNode::create('\Drupal', 'config')
        ->appendArgument($target->id() . '.settings')
        ->appendMethodCall('set')
        ->appendArgument(clone $arguments[0])
        ->appendArgument(clone $arguments[1])
        ->appendMethodCall('save');
    }
  }

}
