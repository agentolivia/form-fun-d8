<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\UnitTests;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Indexer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\UnitTests
 */
class UnitTestsTest extends IndexerTestBase {

  public function setUp() {
    parent::setUp();
    $this->target = new Target('../examples/simpletest_example', new ContainerBuilder());
    $this->indexer = new UnitTests([], 'test', [], $this->db, $this->target);
    $this->indexer->build();
  }

  public function testCount() {
    $this->assertCount(1, $this->indexer);
  }

  public function testHas() {
    $this->assertTrue($this->indexer->has('SimpleTestUnitTestExampleTestCase'));
    $this->assertFalse($this->indexer->has('FooUnitTestCase'));
  }

  /**
   * @depends testHas
   */
  public function testGet() {
    $tests = $this->indexer->get('SimpleTestUnitTestExampleTestCase');
    $this->assertInstanceOf('\Pharborist\NodeCollection', $tests);
    $this->assertCount(1, $tests);
    $test = $tests->get(0);
    $this->assertInstanceOf('\Pharborist\ClassNode', $test);
    $this->assertEquals('SimpleTestUnitTestExampleTestCase', $test->getName()->getText());
  }

  /**
   * @depends testHas
   */
  public function testAdd() {
    $this->indexer->add('FooUnitTestCase', $this->target->getPath('.test'));
    $this->assertTrue($this->indexer->has('FooUnitTestCase'));
  }

  /**
   * @depends testCount
   */
  public function testDelete() {
    $this->indexer->delete('SimpleTestUnitTestExampleTestCase');
    $this->assertCount(0, $this->indexer);
  }

}
