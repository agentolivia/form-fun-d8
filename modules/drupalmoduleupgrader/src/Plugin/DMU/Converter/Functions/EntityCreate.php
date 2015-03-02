<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Objects\ClassMethodCallNode;
use Pharborist\Functions\FunctionCallNode;

/**
 * @Converter(
 *  id = "entity_create",
 *  description = @Translation("Rewrites calls to entity_create().")
 * )
 */
class EntityCreate extends FunctionCallModifier {

  /**
   * {@inheritdoc}
   */
  public function rewrite(FunctionCallNode $call, TargetInterface $target) {
    $arguments = $call->getArguments();

    return ClassMethodCallNode::create('\Drupal', 'entityManager')
      ->appendMethodCall('getStorage')
      ->appendArgument(clone $arguments[0])
      ->appendMethodCall('create')
      ->appendArgument(clone $arguments[1]);
  }

}
