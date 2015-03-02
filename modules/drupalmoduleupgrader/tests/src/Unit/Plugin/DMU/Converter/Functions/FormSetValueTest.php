<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormSetValue;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormSetValue
 */
class FormSetValueTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = FormSetValue::create($this->container, [], 'form_set_value', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('form_set_value($element, $value, $form_state)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$form_state->setValueForElement($element, $value)', $rewritten->getText());
  }

}
