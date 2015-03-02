<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\CToolsObjectCacheSet;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\CToolsObjectCacheSet
 */
class CToolsObjectCacheSetTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = CToolsObjectCacheSet::create($this->container, [], 'ctools_object_cache_set', []);
  }

  public function testRewriteNoSessionID() {
    $function_call = Parser::parseExpression('ctools_object_cache_set("foo", "baz", array())');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::service(\'user.tempstore\')->set("baz", array())', $rewritten->getText());
  }

  public function testRewriteSessionID() {
    $function_call = Parser::parseExpression('ctools_object_cache_set("foo", "baz", array(), "SESSION_ID")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::service(\'user.tempstore\')->set("baz", array())', $rewritten->getText());
  }

}
