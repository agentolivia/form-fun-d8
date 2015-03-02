<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Analyzer;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\InfoFile;
use Drupal\drupalmoduleupgrader\Target;

/**
 * @group DMU.Analyzer
 * @covers \Drupal\drupalmoduleupgrader\Plugin\DMU\Analyzer\InfoFile
 */
class InfoFileTest extends AnalyzerTestBase {

  public function setUp() {
    parent::setUp();

    $this->target = new Target('../examples/vertical_tabs_example', new ContainerBuilder());

    $translator = $this->getMock('\Drupal\Core\StringTranslation\TranslationInterface');
    $translator
      ->expects($this->any())
      ->method('translate')
      ->willReturnArgument(0);

    $this->analyzer = new InfoFile([], 'info', [
      'message' => 'Your info file is wacky!',
      'summary' => NULL,
      'documentation' => [
        [ 'url' => 'http://www.google.com', 'title' => 'Google it, baby.' ],
      ],
      'level' => 'error',
    ], $translator);
  }

  public function test() {
    /** @var \Drupal\drupalmoduleupgrader\IssueInterface $issue */
    $issues = $this->analyzer->analyze($this->target);
    $this->assertInternalType('array', $issues);
    $this->assertArrayHasKey('core', $issues);
    $this->assertArrayHasKey('type', $issues);
    $this->assertArrayNotHasKey('dependencies', $issues);
    $this->assertArrayHasKey('files', $issues);
    $this->assertArrayNotHasKey('configure', $issues);
  }

}
