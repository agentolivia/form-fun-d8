<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Cleaner;

use Drupal\drupalmoduleupgrader\DeriverBase;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Builds derivative definitions for the _delete_hook plugin.
 */
class DeleteHookDeriver extends DeriverBase {

  /**
   * @var string[]
   */
  private $hooks = [];

  public function __construct(TranslationInterface $translator, array $config) {
    parent::__construct($translator);

    $hooks = [];
    foreach ($config as $hook => $info) {
      if (isset($info['delete']) && $info['delete']) {
        $hooks += (array) @($info['hook'] ?: $hook);
      }
    }
    $this->hooks = array_unique($hooks);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
    return new static(
      $container->get('string_translation'),
      $container->get('config.factory')->get('drupalmoduleupgrader.hooks')->get()
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_definition) {
    $derivatives = [];

    foreach ($this->hooks as $hook) {
      $derivative = $base_definition;

      $derivative['hook'] = $hook;
      $derivative['description'] = $this->t('Deletes implementations of hook_@hook().', [
        '@hook' => $hook,
      ]);

      $derivatives[$hook] = $derivative;
    }

    return $derivatives;
  }

}
