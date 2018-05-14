<?php

namespace Extellient\MailBundle\Tests\Template;

use Extellient\MailBundle\Provider\Template\MailTemplateProviderInterface;
use Extellient\MailBundle\Template\MailTemplate;
use Extellient\MailBundle\Template\MailTemplateRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class MailTemplateTest extends TestCase
{
    /**
     * @var MailTemplate
     */
    private $mailTemplate;

    /**
     * @var MailTemplateProviderInterface | MockObject
     */
    private $mailTemplateProvider;

    /**
     * @var \Twig_Environment | MockObject
     */
    private $twig;

    /**
     * @var LoggerInterface | MockObject
     */
    private $logger;

    protected function setUp()
    {
        parent::setUp();
        $this->mailTemplateProvider = $this->createMock(MailTemplateProviderInterface::class);
        $this->twig = $this->createMock(\Twig_Environment::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->mailTemplate = new MailTemplate($this->mailTemplateProvider, $this->twig, $this->logger);
    }

    public function testGetTemplate()
    {
        $mailTemplate = new \Extellient\MailBundle\Entity\MailTemplate();

        $this->mailTemplateProvider
            ->expects($this->once())
            ->method('findOneTemplateByCode')
            ->with('test')
            ->willReturn($mailTemplate);

        $template = $this->mailTemplate->getTemplate('test');
        $this->assertNotNull($template);
        $this->assertInstanceOf(MailTemplateRenderer::class, $template);
    }
}
