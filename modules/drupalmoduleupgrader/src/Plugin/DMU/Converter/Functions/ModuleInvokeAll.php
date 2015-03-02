<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Types\ArrayNode;
use Pharborist\Objects\ClassMethodCallNode;
use Pharborist\Functions\FunctionCallNode;

/**
 * @Converter(
 *  id = "module_invoke_all",
 *  description = @Translation("Rewrites calls to module_invoke_all().")
 * )
 */
class ModuleInvokeAll extends FunctionCallModifier {

  /**
   * {@inheritdoc}
   */
  public function rewrite(FunctionCallNode $call, TargetInterface $target) {
    $arguments = $call->getArguments()->toArray();

    $rewritten = ClassMethodCallNode::create('\Drupal', 'moduleHandler')
      ->appendMethodCall('invokeAll')
      ->appendArgument(array_shift($arguments));

    if ($arguments) {
      $rewritten->appendArgument(ArrayNode::create($arguments));
    }

    return $rewritten;
  }

}
