<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\drupalmoduleupgrader\ConverterBase;
use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Functions\ParameterNode;
use Psr\Log\LoggerInterface;

/**
 * @Converter(
 *  id = "hook_ENTITY_TYPE_view",
 *  description = @Translation("Converts implementations of hook_ENTITY_TYPE_view()."),
 *  hook = {
 *    "comment_view",
 *    "node_view",
 *    "taxonomy_term_view",
 *    "user_view"
 *  },
 *  dependencies = { "plugin.manager.drupalmoduleupgrader.rewriter" }
 * )
 */
class HookEntityTypeView extends ConverterBase {

  /**
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $rewriters;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TranslationInterface $translator, LoggerInterface $log, PluginManagerInterface $rewriters) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $translator, $log);
    $this->rewriters = $rewriters;
  }

  public function convert(TargetInterface $target) {
    $indexer = $target->getIndexer('hook');

    $hooks = array_filter($this->pluginDefinition['hook'], [$indexer, 'has']);
    foreach ($hooks as $hook) {
      /** @var \Pharborist\Functions\FunctionDeclarationNode $function */
      $function = $indexer->get($hook)->get(0);
      $function->prependParameter(ParameterNode::create('build')->setTypeHint('array')->setReference(TRUE));

      $entity_type = subStr($hook, 0, strrPos($hook, '_'));
      $rewriter = $this->rewriters->createInstance('_rewriter:' . $entity_type);
      $this->rewriteFunction($rewriter, $function->getParameterAtIndex(1), $target);
    }
  }

}
