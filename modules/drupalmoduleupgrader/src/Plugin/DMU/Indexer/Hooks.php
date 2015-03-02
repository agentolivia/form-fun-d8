<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Indexer;

use Pharborist\Filter;
use Pharborist\Functions\FunctionDeclarationNode;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Indexer(
 *  id = "hook",
 *  description = @Translation("Indexes all known hook implementations in a target module.")
 * )
 */
class Hooks extends Functions {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    if (empty($configuration['hooks'])) {
      $configuration['hooks'] = [];
    }

    foreach (['analyzer', 'converter', 'cleaner'] as $plugin_type) {
      foreach ($container->get('plugin.manager.drupalmoduleupgrader.' . $plugin_type)->getDefinitions() as $plugin) {
        if (isset($plugin['hook'])) {
          if (is_array($plugin['hook'])) {
            $configuration['hooks'] = array_merge($configuration['hooks'], $plugin['hook']);
          }
          else {
            $configuration['hooks'][] = $plugin['hook'];
          }
        }
      }
    }
    $configuration['hooks'] = array_unique($configuration['hooks']);

    return parent::create($container, $configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $this->prepareTable();
    $hooks = array_map(function($hook) { return $this->target->id() . '_' . $hook; }, $this->configuration['hooks']);

    /** @var \Symfony\Component\Finder\SplFileInfo $file */
    foreach ($this->target->getFinder() as $file) {
      // If you've implemented hooks in your test files...you're not from
      // 'round here, are you boy?
      if ($file->getExtension() == 'test') {
        continue;
      }
      $path = $file->getPathname();

      $this->target
        ->getCodeManager()
        ->open($path)
        ->children(Filter::isInstanceOf('\Pharborist\Functions\FunctionDeclarationNode'))
        ->filter(function(FunctionDeclarationNode $function) use ($hooks) {
          return in_array($function->getName()->getText(), $hooks);
        })
        ->each(function(FunctionDeclarationNode $function) use ($path) {
          $hook = subStr($function->getName()->getText(), strLen($this->target->id()) + 1);
          $this->add($hook, $path);
        });
    }
  }

  /**
   * {@inheritdoc}
   */
  public function get($hook) {
    return $this->target
      ->getCodeManager()
      ->open($this->getFileOf($hook))
      ->children(Filter::isFunction($this->target->id() . '_'. $hook));
  }

}
