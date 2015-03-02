<?php

namespace Drupal\drupalmoduleupgrader\Plugin\DMU\Converter;

use Drupal\drupalmoduleupgrader\ConverterBase;
use Drupal\drupalmoduleupgrader\TargetInterface;
use Pharborist\DocCommentNode;
use Pharborist\RootNode;
use Pharborist\WhitespaceNode;

/**
 * @Converter(
 *  id = "unit_tests",
 *  description = @Translation("Modifies unit test classes.")
 * )
 */
class UnitTests extends ConverterBase {

  /**
   * {@inheritdoc}
   */
  public function isExecutable(TargetInterface $target) {
    return (boolean) $target->getIndexer('unit_test')->count();
  }

  /**
   * {@inheritdoc}
   */
  public function convert(TargetInterface $target) {
    $unit_tests = $target->getIndexer('unit_test')->getAll();

    /** @var \Pharborist\Objects\ClassNode $unit_test */
    foreach ($unit_tests as $unit_test) {
      $unit_test->setExtends('\Drupal\Tests\UnitTestCase');

      $comment_text = <<<END
@FIXME
Unit tests are now written for the PHPUnit framework. You will need to refactor
this test in order for it to work properly.
END;
      $comment = DocCommentNode::create($comment_text);
      $test->setDocComment($comment);

      $ns = 'Drupal\Tests\\' . $target->id() . '\Unit';
      $doc = RootNode::create($ns)->getNamespace($ns)->append($unit_test->remove());
      WhitespaceNode::create("\n\n")->insertBefore($unit_test);

      $this->write($target, 'tests/src/Unit/' . $test->getName() . '.php', "<?php\n\n$doc");
    }
  }

}
