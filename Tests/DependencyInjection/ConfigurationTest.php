<?php

namespace Extellient\MailBundle\Tests\DependencyInjection;

use Extellient\MailBundle\DependencyInjection\Configuration;
use Extellient\MailBundle\Provider\Mail\DoctrineMailProvider;
use Extellient\MailBundle\Provider\Template\DoctrineMailTemplateProvider;
use Extellient\MailBundle\Sender\SwiftMailSender;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

/**
 * Class ConfigurationTest.
 */
class ConfigurationTest extends TestCase
{
    /**
     * @dataProvider dataForProcessedConfiguration
     *
     * @param $configs
     * @param $expectedConfig
     */
    public function testProcessedConfiguration($configs, $expectedConfig)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $this->assertEquals($expectedConfig, $config);
    }

    /**
     * @return array
     */
    public function dataForProcessedConfiguration()
    {
        return [
            [
                [
                    'extellient_mail' => [
                        'mail_address_from' => 'test@test.com',
                        'mail_alias_from' => 'test@test.com',
                        'mail_reply_to' => 'test@test.com',
                    ],
                ],
                [
                    'mail_service_provider' => DoctrineMailProvider::class,
                    'mail_template_service_provider' => DoctrineMailTemplateProvider::class,
                    'mail_sender_service_provider' => SwiftMailSender::class,
                    'mail_address_from' => 'test@test.com',
                    'mail_alias_from' => 'test@test.com',
                    'mail_reply_to' => 'test@test.com',
                ],
            ],
        ];
    }
}
