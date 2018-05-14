<?php

namespace Extellient\MailBundle\DependencyInjection;

use Extellient\MailBundle\Sender\Sender;
use Extellient\MailBundle\Sender\SwiftMailSender;
use Extellient\MailBundle\Services\MailBuilder;
use Extellient\MailBundle\Services\Mailer;
use Extellient\MailBundle\Template\MailTemplate;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class ExtellientMailExtension.
 */
class MailExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $mailProvider = $config['mail_service_provider'];
        $templateProvider = $config['mail_template_service_provider'];
        $senderProvider = $config['mail_sender_service_provider'];
        $mailAddressFrom = $config['mail_address_from'];
        $mailAliasFrom = $config['mail_alias_from'];
        $mailReplyTo = $config['mail_reply_to'];

        $container->getDefinition(MailTemplate::class)->replaceArgument(0, new Reference($templateProvider));

        $container->getDefinition(SwiftMailSender::class)->replaceArgument(1, new Reference($mailProvider));

        $container->getDefinition(Mailer::class)->replaceArgument(0, new Reference($mailProvider));
        $container->getDefinition(Mailer::class)->replaceArgument(1, new Reference(MailBuilder::class));
        $container->getDefinition(MailBuilder::class)->setMethodCalls([
            ['setMailAddressFrom', [$mailAddressFrom]],
            ['setMailAliasFrom', [$mailAliasFrom]],
            ['setMailReplyTo', [$mailReplyTo]]
        ]);

        $container->getDefinition(Sender::class)
            ->replaceArgument(0, new Reference($senderProvider))
            ->replaceArgument(1, new Reference($mailProvider));
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'extellient_mail';
    }
}
