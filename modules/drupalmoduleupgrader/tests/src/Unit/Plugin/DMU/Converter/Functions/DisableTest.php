<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\Disable;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\Disable
 *
 * Currently, the Disable plugin behaves identically for every function it
 * handles (unconditionally returns NULL), so I'm only testing one function.
 */
class DisableTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = Disable::create($this->container, [], '_disable:field_create_field', ['function' => 'field_create_field']);
  }

  public function testRewrite() {
    $function_call = Parser::parseExpression('field_create_field($field)');
    $this->assertNull($this->plugin->rewrite($function_call, $this->target));
  }

}
