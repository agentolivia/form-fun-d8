<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Pharborist\Objects\ClassNode;
use Pharborist\Filter;

/**
 * @Indexer(
 *  id = "test",
 *  description = @Translation("Indexes all tests in a target module."),
 *  exclude = { "DrupalWebTestCase", "DrupalUnitTestCase" }
 * )
 */
class Tests extends Classes {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $this->prepareTable();

    $files = $this->target
      ->getFinder()
      ->filter(function(\SplFileInfo $file) {
        return $file->getExtension() == 'test';
      });

    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($files as $file) {
      $path = $file->getPathname();

      $this->target
        ->getCodeManager()
        ->open($path)
        ->children(Filter::isInstanceOf('\Pharborist\Objects\ClassNode'))
        ->not(function(ClassNode $class) {
          return in_array((string) $class->getExtends(), $this->pluginDefinition['exclude']);
        })
        ->each(function(ClassNode $class) use ($path) {
          $this->add($class->getName()->getText(), $path);
        });
    }
  }

}
