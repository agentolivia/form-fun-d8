<?php

/**
 * @file
 * Contains Drupal\drupalmoduleupgrader\Annotation\Cleaner.
 */

namespace Drupal\drupalmoduleupgrader\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Plugin annotation object for DMU cleaner plugins.
 *
 * Cleaners are plugins which delete dead legacy code from a target module.
 * They're purely destructive: they don't convert anything, they only remove
 * cruft.
 *
 * Plugin Namespace: Plugin\DMU\Cleaner
 *
 * @Annotation
 */
class Cleaner extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * A short description of the clean-up the plugin performs.
   *
   * @var string
   */
  public $description;

  /**
   * If this plugin is specific to a particular hook (or hooks), specifies
   * which one(s) (without the hook_ prefix).
   *
   * @var string
   */
  public $hook;

}
