<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookUninstall;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookUninstall
 */
class HookUninstalltest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../diff', new ContainerBuilder()])
      ->getMock();

    $indexer = new Hooks(['hooks' => ['uninstall']], 'hook', [], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('hook')->willReturn($indexer);

    $this->analyzer = new HookUninstall([], 'hook_uninstall', [
      'message' => 'Do not use variable_del() in hook_uninstall(). Or I will beat you.',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
    $this->assertCount(5, $issue->getViolations());
  }

}
