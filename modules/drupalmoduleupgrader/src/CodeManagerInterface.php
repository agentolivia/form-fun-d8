<?php

namespace Drupal\drupalmoduleupgrader;

use Pharborist\Node;

/**
 * Provides an I/O wrapper around Pharborist syntax trees in order to mitigate
 * the possibility of clobber conditions.
 *
 * When manipulating PHP code with Pharborist, you have a lot of objects open
 * in memory at once. Since PHP always passes objects by reference, there is
 * an excellent chance of changes made by one plugin getting clobbered by
 * another one if every plugin is responsible for its own I/O. This class
 * centralizes the I/O and stores references to every open syntax tree. As long
 * as plugins use this as their I/O backend, they'll always have the most
 * up-to-date version of whatever syntax tree they're working on.
 *
 * So, to quote my own developer docs: for the love of Cthulhu, do not
 * circumvent the code manager.
 */
interface CodeManagerInterface {

  /**
   * Parses a file into a syntax tree, keeping a reference to it, and
   * returns it.
   *
   * @param string $file
   *  The path of the file to open, relative to the CWD.
   *
   * @return \Pharborist\TopNode|NULL
   */
  public function open($file);

  /**
   * Saves the file in which a particular node appears.
   *
   * @param \Pharborist\Node $node
   *  The node to save. This can be positioned anywhere in the
   *  syntax tree.
   *
   * @return boolean
   *  TRUE if the node was saved properly, FALSE otherwise.
   *
   * @throws \Drupal\drupalmoduleupgrader\CodeManagerIOException if the node
   * cannot be saved.
   */
  public function save(Node $node);

  /**
   * Saves all open files.
   */
  public function saveAll();

  /**
   * Creates a new, empty document.
   *
   * @param string $file
   *  The path of the file to create, relative to the CWD.
   *
   * @return \Pharborist\RootNode
   */
  public function create($file);

  /**
   * Clears internal references to all open documents, discarding changes.
   */
  public function flush();

}
