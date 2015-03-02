<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Pharborist\Objects\ClassNode;
use Pharborist\Filter;

/**
 * @Indexer(
 *  id = "unit_test",
 *  description = @Translation("Indexes all unit tests in a target module.")
 * )
 */
class UnitTests extends Classes {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $this->prepareTable();

    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($this->target->getFinder() as $file) {
      if ($file->getExtension() !== 'test') {
        continue;
      }
      $path = $file->getPathname();

      $this->target
        ->getCodeManager()
        ->open($path)
        ->children(Filter::isInstanceOf('\Pharborist\Objects\ClassNode'))
        ->filter(function(ClassNode $class) {
          return $class->getExtends() == 'DrupalUnitTestCase';
        })
        ->each(function(ClassNode $class) use ($path) {
          $this->add($class->getName()->getText(), $path);
        });
    }
  }

}
