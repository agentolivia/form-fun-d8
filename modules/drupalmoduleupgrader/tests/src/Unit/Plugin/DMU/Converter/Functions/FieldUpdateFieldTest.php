<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FieldUpdateField;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 */
class FieldUpdateFieldTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = FieldUpdateField::create($this->container, [], 'field_update_field', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('field_update_field($field)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$field->save()', $rewritten->getText());
  }

}
