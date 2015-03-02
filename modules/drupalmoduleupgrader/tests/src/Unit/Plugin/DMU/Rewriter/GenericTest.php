<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Rewriter;

use Drupal\drupalmoduleupgrader\Plugin\DMU\Rewriter\Generic as GenericRewriter;
use Drupal\Tests\UnitTestCase;
use Pharborist\Parser;

/**
 * @group DMU.Rewriter
 */
class GenericTest extends UnitTestCase {

  /**
   * @var \Drupal\drupalmoduleupgrader\RewriterInterface
   */
  protected $plugin;

  public function setUp() {
    $translator = $this->getMock('\Drupal\Core\StringTranslation\TranslationInterface');
    $translator->method('translate')->willReturnArgument(0);

    $definition = [
      'properties' => [
        'nid' => [
          'get' => 'id',
        ],
        'title' => [
          'get' => 'getTitle',
          'set' => 'setTitle',
        ],
      ],
    ];
    $this->plugin = new GenericRewriter([], '_rewriter:node', $definition, $translator, $this->getMock('\Psr\Log\LoggerInterface'));
  }

  public function testRewriteValidPropertyAsGetter() {
    /** @var \Pharborist\Objects\ObjectPropertyNode $expr */
    $expr = Parser::parseExpression('$node->nid');
    $rewritten = $this->plugin->rewriteAsGetter($expr, 'nid');
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$node->id()', $rewritten->getText());
  }

  public function testRewriteInvalidPropertyAsGetter() {
    /** @var \Pharborist\Objects\ObjectPropertyNode $expr */
    $expr = Parser::parseExpression('$node->baz');
    $rewritten = $this->plugin->rewriteAsGetter($expr, 'baz');
    $this->assertNull($rewritten);
  }

  public function testRewriteValidPropertyAsSetter() {
    /** @var \Pharborist\Operators\AssignNode $expr */
    $expr = Parser::parseExpression('$node->title = "Foobaz"');
    $rewritten = $this->plugin->rewriteAsSetter($expr->getLeftOperand(), 'title', $expr);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectMethodCallNode', $rewritten);
    $this->assertEquals('$node->setTitle("Foobaz")', $rewritten->getText());
  }

  public function testRewriteInvalidPropertyAsSetter() {
    /** @var \Pharborist\Operators\AssignNode $expr */
    $expr = Parser::parseExpression('$node->baz = "Blorf!"');
    $rewritten = $this->plugin->rewriteAsSetter($expr->getLeftOperand(), 'baz', $expr);
    $this->assertNull($rewritten);

    /** @var \Pharborist\Operators\AssignNode $expr */
    $expr = Parser::parseExpression('$node->nid = 30');
    $rewritten = $this->plugin->rewriteAsSetter($expr->getLeftOperand(), 'nid', $expr);
    $this->assertNull($rewritten);
  }

  public function testRewriteFieldLookup() {
    /** @var \Pharborist\ArrayLookupNode $lookup */
    $lookup = Parser::parseExpression('$node->field_foo[LANGUAGE_NONE][0]["value"]');
    $rewritten = GenericRewriter::rewriteFieldLookup($lookup);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectPropertyNode', $rewritten);
    $this->assertEquals('$node->field_foo[0]->value', $rewritten->getText());

    $lookup = Parser::parseExpression('$node->field_foo[\Drupal\Core\Language\Language::LANGCODE_NOT_SPECIFIED][0]["value"]');
    $rewritten = GenericRewriter::rewriteFieldLookup($lookup);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectPropertyNode', $rewritten);
    $this->assertEquals('$node->field_foo[0]->value', $rewritten->getText());

    $lookup = Parser::parseExpression('$node->field_foo["und"][0]["value"]');
    $rewritten = GenericRewriter::rewriteFieldLookup($lookup);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectPropertyNode', $rewritten);
    $this->assertEquals('$node->field_foo[0]->value', $rewritten->getText());

    $lookup = Parser::parseExpression('$node->field_foo["en"][0]["value"]');
    $rewritten = GenericRewriter::rewriteFieldLookup($lookup);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectPropertyNode', $rewritten);
    $this->assertEquals('$node->getTranslation("en")->field_foo[0]->value', $rewritten->getText());

    $lookup = Parser::parseExpression('$node->field_foo["und"][2]["wambooli"]');
    $rewritten = GenericRewriter::rewriteFieldLookup($lookup);
    $this->assertInstanceOf('\Pharborist\Objects\ObjectPropertyNode', $rewritten);
    $this->assertEquals('$node->field_foo[2]->wambooli', $rewritten->getText());
  }

}
