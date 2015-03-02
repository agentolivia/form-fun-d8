<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks
 */
class HooksTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/tablesort_example', new ContainerBuilder());
    // Which hooks the indexer should be aware of.
    $hooks = [
      'help', 'menu', 'install', 'uninstall', 'schema',
    ];
    $this->indexer = new Hooks(['hooks' => $hooks], 'functions', [], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(5, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('help'));
    $this->assertFalse($this->indexer->has('page_alter'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $collection = $this->indexer->get('help');
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
    $this->assertFalse($this->indexer->has('page_alter'));
    $this->indexer->add('page_alter', $this->target->getPath('.module'));
    $this->assertTrue($this->indexer->has('page_alter'));
  }

  /**
   * @depends testHas
   */
  public function testDelete() {
    $this->indexer->delete('help');
    $this->assertFalse($this->indexer->has('help'));
  }


}
