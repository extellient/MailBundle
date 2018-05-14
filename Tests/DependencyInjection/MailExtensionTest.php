<?php

namespace Extellient\MailBundle\Tests\DependencyInjection;

use Extellient\MailBundle\DependencyInjection\MailExtension;
use Extellient\MailBundle\Provider\Mail\DoctrineMailProvider;
use Extellient\MailBundle\Provider\Template\DoctrineMailTemplateProvider;
use Extellient\MailBundle\Sender\Sender;
use Extellient\MailBundle\Sender\SwiftMailSender;
use Extellient\MailBundle\Services\Mailer;
use Extellient\MailBundle\Template\MailTemplate;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class MailExtensionTest.
 */
class MailExtensionTest extends TestCase
{
    public function testGetAlias()
    {
        $mailExtension = new MailExtension();
        $alias = $mailExtension->getAlias();

        $this->assertEquals('extellient_mail', $alias);
    }

    public function testLoadEmptyConfiguration()
    {
        $container = $this->createContainer();
        $container->registerExtension(new MailExtension());
        $container->loadFromExtension('extellient_mail', [
            'mail_address_from' => 'test@test.com',
            'mail_alias_from' => 'test@test.com',
            'mail_reply_to' => 'test@test.com',
        ]);
        $this->compileContainer($container);

        $this->assertEquals(
            DoctrineMailTemplateProvider::class,
            $container->getDefinition(MailTemplate::class)->getArgument(0)
        );
        $this->assertEquals(
            DoctrineMailProvider::class,
            $container->getDefinition(SwiftMailSender::class)->getArgument(1)
        );
        $this->assertEquals(
            DoctrineMailProvider::class,
            $container->getDefinition(Mailer::class)->getArgument(0)
        );

        $this->assertEquals(
            SwiftMailSender::class,
            $container->getDefinition(Sender::class)->getArgument(0)
        );
        $this->assertEquals(
            DoctrineMailProvider::class,
            $container->getDefinition(Sender::class)->getArgument(1)
        );
    }

    private function createContainer()
    {
        $container = new ContainerBuilder(new ParameterBag(array(
            'kernel.cache_dir' => __DIR__,
            'kernel.charset' => 'UTF-8',
            'kernel.debug' => false,
            'kernel.root_dir' => __DIR__,
            'kernel.bundles' => array(),
        )));

        return $container;
    }

    private function compileContainer(ContainerBuilder $container)
    {
        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();
    }
}
