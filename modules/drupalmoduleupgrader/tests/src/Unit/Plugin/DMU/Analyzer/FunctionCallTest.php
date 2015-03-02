<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\FunctionCall;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\FunctionCalls;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\FunctionCall
 */
class FunctionCallTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../examples/entity_example', new ContainerBuilder()])
      ->getMock();

    $indexer = new FunctionCalls([], 'function_call', ['exclude' => ['t']], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('function_call')->willReturn($indexer);

    $this->analyzer = new FunctionCall([], '_function_call:drupal_write_record', [
      'message' => 'Where, oh were did drupal_write_record go?',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
      'function' => 'drupal_write_record',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
    $this->assertCount(1, $issue->getViolations());
  }

}
