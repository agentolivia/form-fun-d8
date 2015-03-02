<?php

namespace Drupal\drupalmoduleupgrader;

/**
 * Represents a Drupal 7 module being run through the DMU.
 */
interface TargetInterface {

  /**
   * Returns the machine name of the target module.
   *
   * @return string
   */
  public function id();

  /**
   * Returns the base path of the target module.
   *
   * @return string
   */
  public function getBasePath();

  /**
   * Returns the path to a particular file, relative to the CWD.
   *
   * @param string $file
   *  The file, relative to the module root. If $file begins with a period,
   *  it will be prefixed with the module name (.module --> MODULE.module)
   *
   * @return string
   */
  public function getPath($file);

  /**
   * Returns a fully configured Finder which can iterate over the target
   * module's code files. Any file type which doesn't contain PHP code
   * should be ignored.
   *
   * @return \Symfony\Component\Finder\Finder
   */
  public function getFinder();

  /**
   * Returns a code manager for the target module.
   *
   * @return CodeManagerInterface
   */
  public function getCodeManager();

  /**
   * Returns an indexer for this target.
   *
   * @param string $which
   *  The type of indexer to get. Should be the ID of an indexer plugin.
   *
   * @return IndexerInterface
   */
  public function getIndexer($which);

  /**
   * Returns services defined by the target module.
   *
   * @return \Doctrine\Common\Collections\ArrayCollection
   */
  public function getServices();

}
