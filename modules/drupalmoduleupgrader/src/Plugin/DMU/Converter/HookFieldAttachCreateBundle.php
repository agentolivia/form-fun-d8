<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter;

use Drupal\drupalmoduleupgrader\ConverterBase;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Converter(
 *  id = "hook_field_attach_create_bundle",
 *  description = @Translation("Renames hook_field_attach_create_bundle()."),
 *  hook = "field_attach_create_bundle"
 * )
 */
class HookFieldAttachCreateBundle extends ConverterBase {

  /**
   * {@inheritdoc}
   */
  public function convert(TargetInterface $target) {
    $hook = $target
      ->getIndexer('hook')
      ->get($this->pluginDefinition['hook'])
      ->get(0)
      ->setName($target->id() . '_entity_bundle_create');

    $target->getCodeManager()->save($hook);
  }

}
