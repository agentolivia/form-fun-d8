<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\FlagHook;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\FlagHook
 */
class FlagHookTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../examples/block_example', new ContainerBuilder()])
      ->getMock();

    $indexer = new Hooks(['hooks' => ['block_info']], 'hook', [], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('hook')->willReturn($indexer);

    $this->analyzer = new FlagHook([], '_flag_hook:block_info', [
      'message' => 'Blocks be plugins now...fool.',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
      'hook' => 'block_info',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
    $this->assertCount(1, $issue->getViolations());
  }

}
