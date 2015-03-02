<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Functions;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Functions
 */
class FunctionsTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/tablesort_example', new ContainerBuilder());
    $this->indexer = new Functions([], 'functions', [], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(6, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('tablesort_example_help'));
    $this->assertFalse($this->indexer->has('t'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $collection = $this->indexer->get('tablesort_example_help');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $collection);
    $this->assertCount(1, $collection);
    $function = $collection->get(0);
    $this->assertInstanceOf('\Pharborist\Functions\FunctionDeclarationNode', $function);
    $this->assertEquals('tablesort_example_help', $function->getName()->getText());
  }

  /**
   * @depends testHas
   */
  public function testAdd() {
    $this->assertFalse($this->indexer->has('foo'));
    $this->indexer->add('foo', $this->target->getPath('.module'));
    $this->assertTrue($this->indexer->has('foo'));
  }

  /**
   * @depends testHas
   */
  public function testDelete() {
    $this->indexer->delete('tablesort_example_page');
    $this->assertFalse($this->indexer->has('tablesort_example_page'));
  }

  public function testQuery() {
    $this->assertInstanceOf('\Drupal\Core\Database\Query\Select', $this->indexer->query());
  }


}
