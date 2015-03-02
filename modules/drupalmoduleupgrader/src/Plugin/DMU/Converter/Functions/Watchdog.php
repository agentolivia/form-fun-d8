<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Types\ArrayNode;
use Pharborist\Objects\ClassMethodCallNode;
use Pharborist\Functions\FunctionCallNode;

/**
 * @Converter(
 *  id = "watchdog",
 *  description = @Translation("Converts calls to watchdog() to \Drupal::logger().")
 * )
 */
class Watchdog extends FunctionCallModifier {

  /**
   * {@inheritdoc}
   */
  public function rewrite(FunctionCallNode $call, TargetInterface $target) {
    $arguments = $call->getArguments();

    // We'll call a specific method on the logger object, depending on the
    // severity passed in the original function call (if any). If there are
    // at least four arguments, a severity was passed.
    $method = sizeof($arguments) > 3 ? strToLower(subStr($arguments[3], 9)) : 'notice';

    // If there is a third argument, and it's an array, a context array
    // was passsed.
    $context = (sizeof($arguments) > 2 && $arguments[2] instanceof ArrayNode) ? clone $arguments[2] : ArrayNode::create([]);

    return ClassMethodCallNode::create('\Drupal', 'logger')
      ->appendArgument(clone $arguments[0])
      ->appendMethodCall($method)
      ->appendArgument(clone $arguments[1])
      ->appendArgument($context);
  }

}
