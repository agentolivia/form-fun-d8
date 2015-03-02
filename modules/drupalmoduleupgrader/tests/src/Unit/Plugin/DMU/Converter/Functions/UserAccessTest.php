<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\UserAccess;
use Pharborist\Parser;

/**
 * @group DMU.Converter.Functions
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\UserAccess
 */
class UserAccessTest extends FunctionCallModifierTest {

  public function setUp() {
    parent::setUp();
    $this->plugin = UserAccess::create($this->container, [], 'user_access', []);
  }

  public function testRewriteCurrentUser() {
    $function_call = Parser::parseExpression('user_access("kick ass and take names")');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('\Drupal::currentUser()->hasPermission("kick ass and take names")', $rewritten->getText());
  }

  public function testRewriteAccount() {
    $function_call = Parser::parseExpression('user_access("be exceptional", $account)');
    $rewritten = $this->plugin->rewrite($function_call, $this->target);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$account->hasPermission("be exceptional")', $rewritten->getText());
  }

}
