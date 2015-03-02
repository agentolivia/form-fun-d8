<?php

namespace Drupal\drupalmoduleupgrader;

use Drupal\Core\Database\Connection as DatabaseConnection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase as CorePluginBase;
use Pharborist\NodeCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base class for indexers.
 */
abstract class IndexerBase extends CorePluginBase implements IndexerInterface, ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\Core\Database\Connection
   */
  protected $db;

  /**
   * @var TargetInterface
   */
  protected $target;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, DatabaseConnection $db, TargetInterface $target = NULL) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->db = $db;

    if ($target) {
      $this->bindTo($target);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function bindTo(TargetInterface $target) {
    $this->target = $target;
  }

  /**
   * {@inheritdoc}
   */
  public function clear() {
    $this->db->truncate($this->table())->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function count($id = NULL) {
    $query = $this->db->select($this->table());
    if ($id) {
      $query->condition('id', $id);
    }
    return $query->countQuery()->execute()->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function has($id) {
    return (boolean) $this->count($id);
  }

  /**
   * {@inheritdoc}
   */
  public function add($id, $file) {
    $this->db
      ->insert($this->table())
      ->fields([
        'id' => $id,
        'file' => $file,
      ])
      ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function delete($id) {
    $this->db->delete($this->table())->condition('id', $id)->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function destroy() {
    $table = $this->table();
    $schema = $this->db->schema();

    if ($schema->tableExists($table)) {
      $schema->dropTable($table);
    }
  }

  /**
   * Returns the name of the index table.
   *
   * @return string
   */
  public function table() {
    return $this->target->id() . '__' . $this->pluginId;
  }

  /**
   * Returns a select query for this indexer's table.
   *
   * @param string[] $fields
   *  Which fields to fetch (all fields if not passed).
   *
   * @return \Drupal\Core\Database\Query\SelectInterface
   */
  public function query(array $fields = []) {
    $table = $this->table();
    return $this->db->select($table)->fields($table, $fields);
  }

  /**
   * Returns the file in which a particular indexed object resides.
   *
   * @param string $id
   *  The object ID.
   *
   * @return string|NULL
   */
  protected function getFileOf($id) {
    return $this
      ->query(['file'])
      ->condition('id', $id)
      ->range(0, 1)
      ->execute()
      ->fetchField();
  }

  /**
   * Clears the database table, or creates if it doesn't exist yet.
   */
  protected function prepareTable() {
    $schema = $this->db->schema();
    $table = $this->table();

    if ($schema->tableExists($table)) {
      $this->clear();
    }
    else {
      $schema->createTable($table, $this->getSchema());
    }
  }

  /**
   * Defines the schema for this indexer's database table.
   *
   * @return array
   */
  protected function getSchema() {
    return [
      'fields' => [
        'id' => [
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ],
        'file' => [
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ],
      ],
    ];
  }

}
