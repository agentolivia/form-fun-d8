<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Drupal\drupalmoduleupgrader\IndexerBase;
use Pharborist\Filter;
use Pharborist\Functions\FunctionCallNode;
use Pharborist\NodeCollection;

/**
 * @Indexer(
 *  id = "function_call",
 *  description = @Translation("Indexes all function calls in a target module."),
 *  exclude = { "t" }
 * )
 */
class FunctionCalls extends IndexerBase {

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
        ->find(Filter::isInstanceOf('\Pharborist\Functions\FunctionCallNode'))
        ->not(function(FunctionCallNode $function_call) {
          return in_array($function_call->getName()->getText(), $this->pluginDefinition['exclude']);
        })
        ->each(function(FunctionCallNode $function_call) use ($path) {
          $this->add($function_call->getName()->getText(), $path);
        });
    }
  }

  /**
   * {@inheritdoc}
   */
  public function get($id) {
    $all = new NodeCollection([]);

    $files = $this
      ->query(['file'])
      ->distinct(TRUE)
      ->condition('id', $id)
      ->execute()
      ->fetchCol();

    array_walk($files, function($file) use ($all, $id) {
      $all->add($this->target->getCodeManager()->open($file)->find(Filter::isFunctionCall($id)));
    });

    return $all;
  }

}
