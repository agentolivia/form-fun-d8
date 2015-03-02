<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormLoadInclude;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FormLoadInclude
 */
class FormLoadIncludeTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = FormLoadInclude::create($this->container, [], 'form_load_include', []);
  }

  public function testRewriteWithoutName() {
    $function_call = Parser::parseExpression('form_load_include($form_state, "inc", "mod_foo")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$form_state->loadInclude("mod_foo", "inc")', $rewritten->getText());
  }

  public function testRewriteWithName() {
    $function_call = Parser::parseExpression('form_load_include($form_state, "inc", "mod_foo", "bazzle")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$form_state->loadInclude("mod_foo", "inc", "bazzle")', $rewritten->getText());
  }

}
