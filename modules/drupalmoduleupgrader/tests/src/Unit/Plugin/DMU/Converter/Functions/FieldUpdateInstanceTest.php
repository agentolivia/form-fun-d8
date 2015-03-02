<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FieldUpdateInstance;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FieldUpdateInstance
 */
class FieldUpdateInstanceTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = FieldUpdateInstance::create($this->container, [], 'field_update_instance', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('field_update_instance($instance)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$instance->save()', $rewritten->getText());
  }

}
