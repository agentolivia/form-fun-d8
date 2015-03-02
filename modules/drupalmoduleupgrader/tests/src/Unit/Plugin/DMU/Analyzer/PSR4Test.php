<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\PSR4;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Classes;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\PSR4
 */
class PSR4Test extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../examples/entity_example', new ContainerBuilder()])
      ->getMock();

    $indexer = new Classes([], 'class', [], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('class')->willReturn($indexer);

    $this->analyzer = new PSR4([], 'PSR4', [
      'message' => 'Make your classes PSR-4. Or I will beat you.',
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
