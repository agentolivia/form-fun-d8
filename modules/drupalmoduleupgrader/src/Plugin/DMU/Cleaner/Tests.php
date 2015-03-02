<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Cleaner;

use Drupal\Core\Plugin\PluginBase;
use Drupal\drupalmoduleupgrader\CleanerInterface;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Cleaner(
 *  id = "tests",
 *  description = @Translation("Deletes all .test files.")
 * )
 */
class Tests extends PluginBase implements CleanerInterface {

  /**
   * {@inheritdoc}
   */
  public function clean(TargetInterface $target) {
    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($target->getFinder() as $file) {
      if ($file->getExtension() == 'test') {
        unlink($file->getPathname());
      }
    }
  }

}
