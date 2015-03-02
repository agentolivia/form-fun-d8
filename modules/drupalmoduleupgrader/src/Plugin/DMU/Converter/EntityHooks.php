<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\drupalmoduleupgrader\ConverterBase;
use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Functions\FunctionCallNode;
use Pharborist\Functions\FunctionDeclarationNode;
use Pharborist\Functions\ParameterNode;
use Psr\Log\LoggerInterface;

/**
 * @Converter(
 *  id = "entity_hooks",
 *  description = @Translation("Rewrites various entity-related hooks."),
 *  hook = {
 *    "comment_delete",
 *    "comment_insert",
 *    "comment_presave",
 *    "comment_update",
 *    "node_access",
 *    "node_access_records",
 *    "node_access_records_alter",
 *    "node_delete",
 *    "node_grants",
 *    "node_grants_alter",
 *    "node_insert",
 *    "node_presave",
 *    "node_revision_delete",
 *    "node_search_result",
 *    "node_submit",
 *    "node_update",
 *    "node_update_index",
 *    "node_validate",
 *    "taxonomy_term_delete",
 *    "taxonomy_term_insert",
 *    "taxonomy_term_presave",
 *    "taxonomy_term_update",
 *    "user_delete",
 *    "user_logout"
 *  },
 *  dependencies = { "plugin.manager.drupalmoduleupgrader.rewriter" }
 * )
 */
class EntityHooks extends ConverterBase {

  /**
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $rewriters;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TranslationInterface $translator, LoggerInterface $log, PluginManagerInterface $rewriters) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $translator, $log);
    $this->rewriters = $rewriters;
  }

  /**
   * {@inheritdoc}
   */
  public function convert(TargetInterface $target, $hook = NULL, $index = 0, $rewriter_id = NULL) {
    $indexer = $target->getIndexer('hook');

    if (isset($hook)) {
      if ($indexer->has($hook)) {
        if (empty($rewriter_id)) {
          $rewriter_id = '_rewriter:' . subStr($hook, 0, strrpos($hook, '_'));
        }
        $rewriter = $this->rewriters->createInstance($rewriter_id);
        $this->rewriteFunction($rewriter, $indexer->get($hook)->get(0)->getParameterAtIndex($index), $target);
      }
    }
    else {
      $this->convert($target, 'comment_delete');
      $this->convert($target, 'comment_insert');
      $this->convert($target, 'comment_presave');
      $this->convert($target, 'comment_update');
      $this->convert($target, 'node_access');
      $this->convert($target, 'node_access', 2, 'account');
      $this->convert($target, 'node_access_records', 0, '_rewriter:node');
      $this->convert($target, 'node_access_records_alter', 1, '_rewriter:node');
      $this->convert($target, 'node_delete');
      $this->convert($target, 'node_grants', 0, 'account');
      $this->convert($target, 'node_grants_alter', 1, 'account');
      $this->convert($target, 'node_insert');
      $this->convert($target, 'node_presave');
      $this->convert($target, 'node_revision_delete');
      $this->convert($target, 'node_search_result');
      $this->convert($target, 'node_submit');
      $this->convert($target, 'node_submit', 2, 'form_state');
      $this->convert($target, 'node_update');
      $this->convert($target, 'node_update_index');
      $this->convert($target, 'node_validate');
      $this->convert($target, 'node_validate', 2, 'form_state');
      $this->convert($target, 'taxonomy_term_delete');
      $this->convert($target, 'taxonomy_term_insert');
      $this->convert($target, 'taxonomy_term_presave');
      $this->convert($target, 'taxonomy_term_update');
      $this->convert($target, 'user_delete');
      $this->convert($target, 'user_logout');
    }
  }

}
