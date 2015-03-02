<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookFormAlter;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Functions;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer\Hooks;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\HookFormAlter
 */
class HookFormAlterTest extends AnalyzerTestBase {

  private $function_indexer, $hook_indexer;

  public function setUp() {
    parent::setUp();

    $this->analyzer = new HookFormAlter([], 'hook_form_alter', [
      'message' => 'Have you been altering forms, boy?',
      'summary' => NULL,
      'documentation' => [],
      'level' => 'error',
    ]);

    $this->function_indexer = new Functions([], 'function', [], $this->db);
    $this->hook_indexer = new Hooks(['hooks' => ['form_alter']], 'hook', [], $this->db);
  }

  private function buildTarget($path) {
    $target = $this->getMockBuilder('\Drupal\drupalmoduleupgrader\Target')
      ->setMethods(['getIndexer'])
      ->setConstructorArgs([$path, new ContainerBuilder()])
      ->getMock();

    $this->function_indexer->bindTo($target);
    $this->function_indexer->build();

    $this->hook_indexer->bindTo($target);
    $this->hook_indexer->build();

    $target
      ->expects($this->any())
      ->method('getIndexer')
      ->willReturnMap([
        [ 'function', $this->function_indexer ],
        [ 'hook', $this->hook_indexer ],
      ]);

    return $target;
  }

  public function testHookFormAlter() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->buildTarget('../examples/vertical_tabs_example'));
    $this->assertIssueDefaults($issue);
    $this->assertCount(1, $issue->getViolations());
  }

  public function testDerivedFormAlter() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issue = $this->analyzer->analyze($this->buildTarget('../diff'));
    $this->assertIssueDefaults($issue);
    $this->assertCount(2, $issue->getViolations());
  }

}
