<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormStateValuesClean;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormStateValuesClean
 */
class FormStateValuesCleanTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = FormStateValuesClean::create($this->container, [], 'form_state_values_clean', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('form_state_values_clean($form_state)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$form_state->cleanValues()', $rewritten->getText());
  }

}
