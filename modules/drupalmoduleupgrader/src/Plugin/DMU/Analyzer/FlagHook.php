<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer;

use Drupal\drupalmoduleupgrader\AnalyzerBase;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Analyzer(
 *  id = "_flag_hook",
 *  deriver = "\Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\FlagHookDeriver"
 * )
 */
class FlagHook extends AnalyzerBase {

  /**
   * {@inheritdoc}
   */
  public function analyze(TargetInterface $target) {
    $hook = $this->pluginDefinition['hook'];
    $indexer = $target->getIndexer('hook');

    if ($indexer->has($hook)) {
      return $this->buildIssue($target)->addViolation($indexer->get($hook)->get(0), $this);
    }
  }

}
