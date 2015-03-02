<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\WebTests;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\WebTests
 */
class WebTestsTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/simpletest_example', new ContainerBuilder());
    $this->indexer = new WebTests([], 'test', [], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(2, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('SimpleTestExampleTestCase'));
    $this->assertFalse($this->indexer->has('FooWebTestCase'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $tests = $this->indexer->get('SimpleTestExampleTestCase');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $tests);
    $this->assertCount(1, $tests);
    $test = $tests->get(0);
    $this->assertInstanceOf('\Pharborist\ClassNode', $test);
    $this->assertEquals('SimpleTestExampleTestCase', $test->getName()->getText());
  }

  /**
   * @depends testHas
   */
  public function testAdd() {
    $this->indexer->add('FooWebTestCase', $this->target->getPath('.test'));
    $this->assertTrue($this->indexer->has('FooWebTestCase'));
  }

  /**
   * @depends testCount
   */
  public function testDelete() {
    $this->indexer->delete('SimpleTestExampleTestCase');
    $this->assertCount(1, $this->indexer);
  }

}
