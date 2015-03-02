<?php

namespace Drupal\drupalmoduleupgrader;

/**
 * Interface for plugins which can scan a target module to collect information
 * about what it contains. Indexers are always run before other plugin types,
 * and all available indexers are always run. All information collected by
 * indexers is available to the other plugin types via TargetInterface's
 * getIndexer() method.
 */
interface IndexerInterface extends \Countable {

  /**
   * Binds the indexer to a target module. This should clear any existing
   * index data.
   *
   * @param TargetInterface $target
   *  The target module.
   */
  public function bindTo(TargetInterface $target);

  /**
   * Indexes the current target module.
   */
  public function build();

  /**
   * Clears all current index data.
   */
  public function clear();

  /**
   * Returns the number of objects in this index, or the number of objects
   * with a certain ID (if the ID is repeatable).
   *
   * @return integer
   */
  public function count($id = NULL);

  /**
   * Returns if the index has at least one object with a certain ID.
   *
   * @param string $id
   *  The object ID.
   *
   * @return boolean
   */
  public function has($id);

  /**
   * Returns indexed object(s).
   *
   * @param string $id
   *  The object ID.
   *
   * @return \Pharborist\NodeCollection
   */
  public function get($id);

  /**
   * Adds an object to the index.
   *
   * @param string $id
   *  The object ID.
   * @param string $file
   *  The path of the file which contains the object.
   */
  public function add($id, $file);

  /**
   * Deletes an object from the index.
   *
   * @param string $id
   *  The object ID.
   */
  public function delete($id);

  /**
   * Destroys the index.
   */
  public function destroy();

}
