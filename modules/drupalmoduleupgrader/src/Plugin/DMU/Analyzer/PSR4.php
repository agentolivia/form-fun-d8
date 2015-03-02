<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer;

use Drupal\drupalmoduleupgrader\AnalyzerBase;
use Drupal\drupalmoduleupgrader\TargetInterface;

/**
 * @Analyzer(
 *  id = "PSR4",
 *  description = @Translation("Checks if the module defines any classes that need to be moved into a PSR-4 structure."),
 *  documentation = {
 *    {
 *      "url" = "https://www.drupal.org/node/2246699",
 *      "title" = @Translation("PSR-4 compatible class loader in Drupal core")
 *    }
 *  },
 *  tags = {
 *    "category" = { "misc", "system" }
 *  },
 *  message = @Translation("Classes must be PSR-4 compliant.")
 * )
 */
class PSR4 extends AnalyzerBase {

  /**
   * {@inheritdoc}
   */
  public function analyze(TargetInterface $target) {
    if ($target->getIndexer('class')->count() > 0) {
      return $this->buildIssue($target);
    }
  }

}
