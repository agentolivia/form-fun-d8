<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\CacheGet;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\CacheGet
 */
class CacheGetTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = CacheGet::create($this->container, [], 'cache_get', []);
  }

  public function testRewriteDefaultBin() {
    $function_call = Parser::parseExpression('cache_get("foo")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::cache()->get("foo")', $rewritten->getText());
  }

  public function testRewriteSpecificBin() {
    $function_call = Parser::parseExpression('cache_get("baz", "foo")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::cache("foo")->get("baz")', $rewritten->getText());
  }

}
