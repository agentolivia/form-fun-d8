<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Drupal\drupalmoduleupgrader\IndexerBase;
use Pharborist\Functions\DefineNode;
use Pharborist\Filter;
use Pharborist\Types\ScalarNode;

/**
 * @Indexer(
 *  id = "constant",
 *  description = @Translation("Evaluates all scalar constants in the target module.")
 * )
 */
class Constants extends IndexerBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($this->target->getFinder() as $file) {
      $path = $file->getPathname();

      // Here's an ugly hack to deal with problems arising from the use of
      // unevaluated constants. This will scan the current file for any
      // define() calls, and if the constant is scalar, eval() it into
      // existence.
      //
      // Yeah, it's a kludge. I'm sorry you had to see this.
      $this->target
        ->getCodeManager()
        ->open($path)
        ->find(Filter::isFunctionCall('define'))
        ->filter(function(DefineNode $define) {
          return $define->getArgumentList()->getItem(1) instanceof ScalarNode;
        })
        ->each(function(DefineNode $define) {
          // Forgive me, lord!
          eval($define->getText() . ';');
        });
    }
  }

  /**
   * {@inheritdoc}
   */
  public function get($id) {
    if (defined($id)) {
      return constant($id);
    }
  }

}
