<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\FunctionCalls;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\FunctionCalls
 */
class FunctionCallsTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/js_example', new ContainerBuilder());
    $this->indexer = new FunctionCalls([], 'function_call', ['exclude' => ['t']], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(16, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('drupal_add_js'));
    $this->assertFalse($this->indexer->has('t'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $collection = $this->indexer->get('drupal_add_js');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $collection);
    $this->assertCount(7, $collection);

    $collection = $this->indexer->get('t');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $collection);
    $this->assertTrue($collection->isEmpty());
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
    $this->indexer->delete('drupal_add_js');
    $this->assertFalse($this->indexer->has('drupal_add_js'));
  }

}
