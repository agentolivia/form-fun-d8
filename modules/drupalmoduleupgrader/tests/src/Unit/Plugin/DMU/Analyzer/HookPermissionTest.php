<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookPermission;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookPermission
 *
 * @todo Add a test for dynamic permissions. Drupal 8 still uses
 * hook_permission() for this, so dynamic permissions should not result in
 * an issue being flagged.
 */
class HookPermissionTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs(['../examples/entity_example', new ContainerBuilder()])
      ->getMock();

    $indexer = new Hooks(['hooks' => ['permission']], 'hook', [], $this->db, $this->target);
    $indexer->build();
    $this->target->expects($this->any())->method('getIndexer')->with('hook')->willReturn($indexer);

    $this->analyzer = new HookPermission([], 'hook_permission', [
      'message' => 'Permission granted...HAH!',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
    ]);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->target);
    $this->assertIssueDefaults($issue);
    $this->assertCount(1, $issue->getViolations());
  }

}
