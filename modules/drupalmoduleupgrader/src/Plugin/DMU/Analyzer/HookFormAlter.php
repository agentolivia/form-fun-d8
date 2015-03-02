<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer;

use Drupal\drupalmoduleupgrader\AnalyzerBase;
use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\Filter;
use Pharborist\Functions\FunctionDeclarationNode;

/**
 * @Analyzer(
 *  id = "hook_form_alter",
 *  description = @Translation("Checks for outdated hook_form_alter() implementations."),
 *  documentation = {
 *    {
 *      "url" = "https://api.drupal.org/api/drupal/core%21modules%21system%21system.api.php/function/hook_form_alter/8",
 *      "title" = @Translation("`hook_form_alter()` documentation")
 *    }
 *  },
 *  tags = {
 *    "category" = { "form" }
 *  },
 *  message = @Translation("The signature of hook_form_alter() has changed in Drupal 8.")
 * )
 */
class HookFormAlter extends AnalyzerBase {

  /**
   * {@inheritdoc}
   */
  public function analyze(TargetInterface $target) {
    $violations = [];

    $indexer = $target->getIndexer('hook');
    if ($indexer->has('form_alter')) {
      $violations[] = $indexer->get('form_alter')->get(0);
    }

    $id = $target->id() . '_form_%_alter';
    // Until kernel tests are run in PHPUnit, we need to check for
    // the existence of db_like().
    if (function_exists('db_like')) {
      $id = db_like($id);
    }
    $alter_hooks = $target
      ->getIndexer('function')
      ->query()
      ->condition('id', $id, 'LIKE')
      ->execute();

    foreach ($alter_hooks as $alter_hook) {
      $violations[] = $target
        ->getCodeManager()
        ->open($alter_hook->file)
        ->find(Filter::isFunction($alter_hook->id))
        ->get(0);
    }

    if ($violations) {
      $issue = $this->buildIssue($target);
      array_walk($violations, function(FunctionDeclarationNode $function) use ($issue) {
        $issue->addViolation($function, $this);
      });
      return $issue;
    }
  }

}
