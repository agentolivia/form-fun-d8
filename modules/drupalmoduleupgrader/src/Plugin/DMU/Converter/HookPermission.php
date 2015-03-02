<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter;

use Drupal\drupalmoduleupgrader\ConverterBase;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Converter(
 *  id = "hook_permission",
 *  description = @Translation("Converts static implementations of hook_permission() to YAML."),
 *  hook = "permission"
 * )
 */
class HookPermission extends ConverterBase {

  /**
   * {@inheritdoc}
   */
  public function convert(TargetInterface $target) {
    try {
      $permissions = $this->executeHook($target, $this->pluginDefinition['hook']);
      $this->writeInfo($target, 'permissions', $permissions);
    }
    catch (\LogicException $e) {
      return;
    }
  }

}
