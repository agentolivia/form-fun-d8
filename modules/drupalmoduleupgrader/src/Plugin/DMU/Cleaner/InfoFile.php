<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Cleaner;

use Drupal\Core\Plugin\PluginBase;
use Drupal\drupalmoduleupgrader\CleanerInterface;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Cleaner(
 *  id = "info",
 *  description = @Translation("Deletes the target module's Drupal 7 .info file.")
 * )
 */
class InfoFile extends PluginBase implements CleanerInterface {

  /**
   * {@inheritdoc}
   */
  public function clean(TargetInterface $target) {
    unlink($target->getPath('.info'));
  }

}
