<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Cleaner;

use Drupal\Core\Plugin\PluginBase;
use Drupal\drupalmoduleupgrader\CleanerInterface;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Cleaner(
 *  id = "_delete_hook",
 *  deriver = "\Drupal\drupalmoduleupgrader\Plugin\DMU\Cleaner\DeleteHookDeriver"
 * )
 */
class DeleteHook extends PluginBase implements CleanerInterface {

  /**
   * {@inheritdoc}
   */
  public function clean(TargetInterface $target) {
    $hook = $this->pluginDefinition['hook'];
    $indexer = $target->getIndexer('hook');

    if ($indexer->has($hook)) {
      $function = $indexer->get($hook)->get(0);
      $doc = $function->parents()->get(0);
      $function->remove();
      $indexer->delete($hook);
      $target->getCodeManager()->save($doc);
    }
  }

}
