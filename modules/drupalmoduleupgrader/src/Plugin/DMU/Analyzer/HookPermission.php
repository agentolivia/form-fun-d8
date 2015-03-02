<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer;

use Drupal\drupalmoduleupgrader\AnalyzerBase;
use Drupal\drupalmoduleupgrader\TargetInterface;
use Drupal\drupalmoduleupgrader\Utility\Filter\ContainsLogicFilter;

/**
 * @Analyzer(
 *  id = "hook_permission",
 *  description = @Translation("Analyzes implementations of hook_permission()."),
 *  documentation = {
 *    {
 *      "url" = "https://www.drupal.org/node/2311427",
 *      "title" = @Translation("Defining permissions in `MODULE.permissions.yml`")
 *    }
 *  },
 *  tags = {
 *    "category" = { "system", "user" },
 *    "error_level" = "warning"
 *  },
 *  hook = "permission",
 *  message = @Translation("Static permissions are now defined in `MODULE.permissions.yml`.")
 * )
 */
class HookPermission extends AnalyzerBase {

  /**
   * {@inheritdoc}
   */
  public function analyze(TargetInterface $target) {
    $indexer = $target->getIndexer('hook');
    
    if ($indexer->has('permission')) {
      $contains_logic = new ContainsLogicFilter();
      $contains_logic->whitelist('t');

      $hook = $indexer->get('permission')->get(0);
      if (! $hook->is($contains_logic)) {
        return $this->buildIssue($target)->addViolation($hook, $this);
      }
    }
  }

}
