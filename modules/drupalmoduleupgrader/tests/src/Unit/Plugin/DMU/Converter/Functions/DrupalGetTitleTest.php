<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalGetTitle;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalGetTitle
 */
class DrupalGetTitleTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = new DrupalGetTitle([], 'drupal_get_title', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('drupal_get_title()');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::service(\'title_resolver\')->getTitle(\Drupal::request(), \Drupal::routeMatch()->getRouteObject())', $rewritten->getText());
  }

}
