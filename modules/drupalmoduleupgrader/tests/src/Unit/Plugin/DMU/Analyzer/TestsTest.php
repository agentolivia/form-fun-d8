<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\Tests;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Tests as TestsIndexer;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\UnitTests;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\WebTests;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\Tests
 */
class TestsTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../pants', new ContainerBuilder()])
      ->getMock();

    $tests_indexer = new TestsIndexer([], 'test', ['exclude' => ['DrupalWebTestCase', 'DrupalUnitTestCase']], $this->db, $this->target);
    $tests_indexer->build();

    $web_tests_indexer = new WebTests([], 'web_test', [], $this->db, $this->target);
    $web_tests_indexer->build();

    $unit_tests_indexer = new UnitTests([], 'unit_test', [], $this->db, $this->target);
    $unit_tests_indexer->build();

    $this->target
      ->expects($this->any())
      ->method('getIndexer')
      ->willReturnMap([
        ['test', $tests_indexer],
        ['web_test', $web_tests_indexer],
        ['unit_test', $unit_tests_indexer],
      ]);

    $this->analyzer = new Tests([], 'tests', [
      'message' => 'You have tests. You will convert them. Or you will have no tests.',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
  }

}
