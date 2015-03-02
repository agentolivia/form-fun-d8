<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Drupal\drupalmoduleupgrader\IndexerBase;
use Pharborist\Filter;
use Pharborist\Functions\FunctionDeclarationNode;

/**
 * @Indexer(
 *  id = "function",
 *  description = @Translation("Indexes all functions in a target module.")
 * )
 */
class Functions extends IndexerBase {

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
        ->children(Filter::isInstanceOf('\Pharborist\Functions\FunctionDeclarationNode'))
        ->each(function(FunctionDeclarationNode $function) use ($path) {
          $this->add($function->getName()->getText(), $path);
        });
    }
  }

  /**
   * {@inheritdoc}
   */
  public function get($function) {
    return $this->target
      ->getCodeManager()
      ->open($this->getFileOf($function))
      ->children(Filter::isFunction($function));
  }

}
