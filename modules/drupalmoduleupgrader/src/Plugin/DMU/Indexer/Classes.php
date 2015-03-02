<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Drupal\drupalmoduleupgrader\IndexerBase;
use Pharborist\Objects\ClassNode;
use Pharborist\Filter;
use Pharborist\NodeCollection;

/**
 * @Indexer(
 *  id = "class",
 *  description = @Translation("Indexes all classes (except tests) in a target module.")
 * )
 */
class Classes extends IndexerBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $this->prepareTable();

    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($this->target->getFinder() as $file) {
      $path = $file->getPathname();

      $this->target
        ->getCodeManager()
        ->open($path)
        ->children(Filter::isInstanceOf('\Pharborist\Objects\ClassNode'))
        ->not(function(ClassNode $class) {
          return preg_match('/TestCase$/', (string) $class->getExtends());
        })
        ->each(function(ClassNode $class) use ($path) {
          $this->add($class->getName()->getText(), $path);
        });
    }
  }

  /**
   * {@inheritdoc}
   */
  public function get($class) {
    return $this->target
      ->getCodeManager()
      ->open($this->getFileOf($class))
      ->find(Filter::isClass($class));
  }

  /**
   * @return \Pharborist\NodeCollection
   */
  public function getAll() {
    $all = new NodeCollection();

    foreach ($this->query()->execute() as $row) {
      $all->add($this->target
        ->getCodeManager()
        ->open($row->file)
        ->find(Filter::isClass($row->id))
      );
    }

    return $all;
  }

}
