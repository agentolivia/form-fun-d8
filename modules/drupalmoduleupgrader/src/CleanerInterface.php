<?php

namespace Drupal\drupalmoduleupgrader;

/**
 * Interface for plugins which can delete dead legacy code from a target module.
 */
interface CleanerInterface {

  /**
   * Deletes old, dead code and legacy cruft from the target module.
   *
   * @param TargetInterface $target
   *  The target module.
   */
  public function clean(TargetInterface $target);

}
