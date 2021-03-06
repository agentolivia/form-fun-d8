<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\ModuleInvokeAll;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\ModuleInvokeAll
 */
class ModuleInvokeAllTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = ModuleInvokeAll::create($this->container, [], 'module_invoke_all', []);
  }

  public function testRewriteWithoutArguments() {
    $function_call = Parser::parseExpression('module_invoke_all("cer_fields")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::moduleHandler()->invokeAll("cer_fields")', $rewritten->getText());
  }

  public function testRewriteWithArguments() {
    $function_call = Parser::parseExpression('module_invoke_all("menu_alter", $menu)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::moduleHandler()->invokeAll("menu_alter", [$menu])', $rewritten->getText());
  }

}
