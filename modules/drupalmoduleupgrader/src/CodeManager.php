<?php

namespace Drupal\drupalmoduleupgrader;

use Pharborist\Node;
use Pharborist\Parser;
use Pharborist\RootNode;

/**
 * Generic code manager implementation.
 */
class CodeManager implements CodeManagerInterface {

  /**
   * All open documents.
   *
   * @var RootNode[]
   */
  protected $documents = [];

  /**
   * {@inheritdoc}
   */
  public function open($file) {
    if (empty($this->documents[$file])) {
      $this->documents[$file] = Parser::parseFile($file);
    }
    return $this->documents[$file];
  }

  /**
   * {@inheritdoc}
   */
  public function save(Node $node) {
    $file = $this->getFileOf($node);
    if ($file) {
      $doc = $node instanceof RootNode ? $node : $node->parents()->get(0);
      return (boolean) file_put_contents($file, $doc->getText());
    }
    else {
      throw new CodeManagerIOException('Cannot save a node that is not attached to an open document.');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function saveAll() {
    foreach ($this->documents as $file => $doc) {
      file_put_contents($file, $doc->getText());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function create($file, $ns = NULL) {
    $this->documents[$file] = RootNode::create($ns);
    return $this->documents[$file];
  }

  /**
   * {@inheritdoc}
   */
  public function flush() {
    $this->documents = [];
  }

  /**
   * Determines which currently-open file a node belongs to, if any. Nodes
   * which are not part of any open syntax tree will return NULL.
   *
   * @return string|NULL
   */
  public function getFileOf(Node $node) {
    if ($node instanceof RootNode) {
      $root = $node;
    }
    else {
      $parents = $node->parents();
      if ($parents->isEmpty()) {
        return NULL;
      }
      $root = $parents->get(0);
    }

    foreach ($this->documents as $file => $doc) {
      if ($root === $doc) {
        return $file;
      }
    }
  }

}
