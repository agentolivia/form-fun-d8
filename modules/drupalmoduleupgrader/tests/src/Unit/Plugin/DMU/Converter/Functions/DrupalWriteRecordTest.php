<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalWriteRecord;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalWriteRecord
 */
class DrupalWriteRecordTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = DrupalWriteRecord::create($this->container, [], 'drupal_write_record', []);
  }

  public function testRewriteUpdateArrayKey() {
    $function_call = Parser::parseExpression('drupal_write_record("foobar", $record, array("id"));');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::database()->merge("foobar")->fields($record)->key(array("id"))->execute()', $rewritten->getText());
  }

  public function testRewriteUpdateStringKey() {
    $function_call = Parser::parseExpression('drupal_write_record("foobar", $record, "baz")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::database()->merge("foobar")->fields($record)->key(["baz"])->execute()', $rewritten->getText());
  }

  public function testRewriteInsert() {
    $function_call = Parser::parseExpression('drupal_write_record("foobar", $record)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::database()->insert("foobar")->fields($record)->execute()', $rewritten->getText());
  }

}
