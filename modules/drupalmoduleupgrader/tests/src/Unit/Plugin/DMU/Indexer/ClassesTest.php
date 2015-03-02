<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Classes;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Classes
 */
class ClassesTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/entity_example', new ContainerBuilder());
    $this->indexer = new Classes([], 'class', [], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(1, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('EntityExampleBasicController'));
    $this->assertFalse($this->indexer->has('FooEntityController'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $classes = $this->indexer->get('EntityExampleBasicController');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $classes);
    $this->assertCount(1, $classes);
    $class = $classes->get(0);
    $this->assertInstanceOf('\Pharborist\ClassNode', $class);
    $this->assertEquals('EntityExampleBasicController', $class->getName()->getText());
  }

  /**
   * @depends testHas
   */
  public function testAdd() {
    $this->indexer->add('FooEntityController', $this->target->getPath('.module'));
    $this->assertTrue($this->indexer->has('FooEntityController'));
  }

  /**
   * @depends testCount
   */
  public function testDelete() {
    $this->indexer->delete('EntityExampleBasicController');
    $this->assertCount(0, $this->indexer);
  }

}
