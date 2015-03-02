<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\DB;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\FunctionCalls;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\DB
 */
class DBTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../diff', new ContainerBuilder()])
      ->getMock();

    $indexer = new FunctionCalls([], 'function_call', ['exclude' => ['t']], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('function_call')->willReturn($indexer);

    $this->analyzer = new DB([], '_db:db_delete', [
      'message' => 'Shiva is not pleased with your module.',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
      'function' => 'db_delete',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
    $this->assertCount(3, $issue->getViolations());
  }

}
