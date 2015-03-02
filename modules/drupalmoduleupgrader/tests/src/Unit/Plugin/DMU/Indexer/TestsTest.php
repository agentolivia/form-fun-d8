<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Tests;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Tests
 */
class TestsTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/action_example', new ContainerBuilder());
    $this->indexer = new Tests([], 'test', ['exclude' => ['DrupalWebTestCase', 'DrupalUnitTestCase']], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(1, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('ActionExampleTestCase'));
    $this->assertFalse($this->indexer->has('FooTestCase'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $tests = $this->indexer->get('ActionExampleTestCase');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $tests);
    $this->assertCount(1, $tests);
    $test = $tests->get(0);
    $this->assertInstanceOf('\Pharborist\ClassNode', $test);
    $this->assertEquals('ActionExampleTestCase', $test->getName()->getText());
  }

  /**
   * @depends testHas
   */
  public function testAdd() {
    $this->indexer->add('FooTestCase', $this->target->getPath('.test'));
    $this->assertTrue($this->indexer->has('FooTestCase'));
  }

  /**
   * @depends testCount
   */
  public function testDelete() {
    $this->indexer->delete('ActionExampleTestCase');
    $this->assertCount(0, $this->indexer);
  }

}
