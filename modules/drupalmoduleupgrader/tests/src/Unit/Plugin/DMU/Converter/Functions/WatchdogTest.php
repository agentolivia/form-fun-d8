<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\Watchdog;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\Watchdog
 */
class WatchdogTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = Watchdog::create($this->container, [], 'watchdog', []);
  }

  public function testRewriteNoVariablesDefaultSeverity() {
    $function_call = Parser::parseExpression('watchdog("foo", "Hi!")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::logger("foo")->notice("Hi!", [])', $rewritten->getText());
  }

  public function testRewriteVariablesDefaultSeverity() {
    $function_call = Parser::parseExpression('watchdog("foo", "Hej", array("baz"))');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::logger("foo")->notice("Hej", array("baz"))', $rewritten->getText());
  }

  public function testRewriteNoVariablesSeverity() {
    $function_call = Parser::parseExpression('watchdog("foo", "Harrr", NULL, WATCHDOG_WARNING)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::logger("foo")->warning("Harrr", [])', $rewritten->getText());
  }

  public function testRewriteVariablesSeverity() {
    $function_call = Parser::parseExpression('watchdog("foo", "Hurrr", array("baz"), WATCHDOG_ERROR)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::logger("foo")->error("Hurrr", array("baz"))', $rewritten->getText());
  }

}
