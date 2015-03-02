<?php

namespace Drupal\Tests\drupalmoduleupgrader\Unit\Plugin\DMU\Converter\Functions;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Tests\UnitTestCase;

abstract class FunctionCallModifierTest extends UnitTestCase {

  /**
   * @var \Drupal\drupalmoduleupgrader\TargetInterface
   */
  protected $target;

  /**
   * @var \Drupal\drupalmoduleupgrader\Plugin\DMU\Converter\Functions\FunctionCallModifier
   */
  protected $plugin;

  /**
   * @var \Symfony\Component\DependencyInjection\ContainerInterface
   */
  protected $container;

  public function setUp() {
    $this->target = $this->getMock('\Drupal\drupalmoduleupgrader\TargetInterface');
    $this->target->method('id')->willReturn('foo');

    $this->container = new ContainerBuilder();

    $translator = $this->getMock('\Drupal\Core\StringTranslation\TranslationInterface');
    $translator->method('translate')->willReturnArgument(0);
    $this->container->set('string_translation', $translator);

    $logger = $this->getMock('\Psr\Log\LoggerInterface');
    $logger_factory = $this->getMock('\Drupal\Core\Logger\LoggerChannelFactoryInterface');
    $logger_factory->method('get')->willReturn($logger);
    $this->container->set('logger.factory', $logger_factory);
  }

}
