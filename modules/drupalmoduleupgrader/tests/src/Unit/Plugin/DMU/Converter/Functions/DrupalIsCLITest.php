<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalIsCLI;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\DrupalIsCLI
 */
class DrupalIsCLITest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = new DrupalIsCLI([], 'drupal_is_cli', []);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('drupal_is_cli()');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\ExpressionNode', $rewritten);
    $this->assertEquals('PHP_SAPI === "cli"', $rewritten->getText());
  }

}
