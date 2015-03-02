<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\Database\Driver\sqlite\Connection;
use Drupal\Tests\UnitTestCase;

abstract class AnalyzerTestBase extends UnitTestCase {

  /**
   * @var \Drupal\drupalmoduleupgrader\TargetInterface
   */
  protected $target;

  /**
   * @var \Drupal\drupalmoduleupgrader\AnalyzerInterface
   */
  protected $analyzer;

  /**
   * @var \Drupal\Core\Database\Connection
   */
  protected $db;

  public function setUp() {
    $pdo = new \PDO('sqlite::memory:');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $this->db = new Connection($pdo, []);
  }

  protected function assertIssueDefaults($issue) {
    $this->assertInstanceOf('\Drupal\drupalmoduleupgrader\IssueInterface', $issue);

    $plugin_definition = $this->analyzer->getPluginDefinition();
    $this->assertEquals($plugin_definition['message'], $issue->getTitle());
    $this->assertEquals($plugin_definition['summary'], $issue->getSummary());
    $this->assertSame($issue->getDocumentation(), $plugin_definition['documentation']);
    $this->assertEquals($plugin_definition['level'], $issue->getErrorLevel());
  }

}
