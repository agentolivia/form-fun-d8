<?php

namespace Drupal\drupalmoduleupgrader;

/**
 * Interface for plugins which can analyze a target module and flag potential
 * or existing issues.
 */
interface AnalyzerInterface {

  /**
   * Analyzes a target module and flags any issues found.
   *
   * @param TargetInterface $target
   *  The target module.
   *
   * @return IssueInterface|IssueInterface[]|NULL
   *  A single issue, an array of issues, or NULL to indicate that no issues
   *  were found.
   */
  public function analyze(TargetInterface $target);

}
