<?php

namespace Extellient\MailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('extellient_mail');

        $rootNode
            ->children()
                ->scalarNode('mail_service_provider')
                    ->defaultValue('Extellient\MailBundle\Provider\Mail\DoctrineMailProvider')
                ->end()
                ->scalarNode('mail_template_service_provider')
                    ->defaultValue('Extellient\MailBundle\Provider\Template\DoctrineMailTemplateProvider')
                ->end()
                ->scalarNode('mail_sender_service_provider')
                    ->defaultValue('Extellient\MailBundle\Sender\SwiftMailSender')
                ->end()
                ->scalarNode('mail_address_from')
                    ->isRequired()
                ->end()
                ->scalarNode('mail_alias_from')
                    ->isRequired()
                ->end()
                ->scalarNode('mail_reply_to')
                    ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
