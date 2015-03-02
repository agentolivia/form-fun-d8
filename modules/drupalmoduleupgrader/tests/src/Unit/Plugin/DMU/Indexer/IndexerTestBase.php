<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Indexer;

use Drupal\Core\Database\Driver\sqlite\Connection;
use Drupal\Tests\UnitTestCase;

abstract class IndexerTestBase extends UnitTestCase {

  protected $db, $indexer, $target;

  public function setUp() {
    $this->db = new Connection(new \PDO('sqlite::memory:'), []);
  }

  public function testClear() {
    $this->indexer->clear();
    $this->assertCount(0, $this->indexer);
  }

  public function testDestroy() {
    $this->indexer->destroy();
    $this->assertFalse($this->db->schema()->tableExists($this->indexer->table()));
  }

}
