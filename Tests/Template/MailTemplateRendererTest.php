<?php

namespace Extellient\MailBundle\Tests\Template;

use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotGeneratedException;
use Extellient\MailBundle\Template\MailTemplateRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Class MailTemplateRendererTest.
 */
class MailTemplateRendererTest extends TestCase
{
    /**
     * @var MailTemplateRenderer|MockObject
     */
    private $mailTemplateRenderer;
    /**
     * @var \Twig_Environment|MockObject
     */
    private $twig;
    /**
     * @var MailTemplateInterface|MockObject
     */
    private $mailTemplate;
    /**
     * @var LoggerInterface|MockObject
     */
    private $logger;

    protected function setUp()
    {
        parent::setUp();
        $this->twig = $this->createMock(\Twig_Environment::class);
        $this->mailTemplate = $this->createMock(MailTemplateInterface::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->mailTemplateRenderer = new MailTemplateRenderer($this->twig, $this->mailTemplate, $this->logger);
    }

    public function testGetBodyNotGenerated()
    {
        $this->twig->expects($this->once())->method('createTemplate')->will($this->throwException(new \Twig_Error('')));

        $this->logger->expects($this->once())->method('error');

        $this->expectException(MailTemplateNotGeneratedException::class);

        $this->mailTemplateRenderer->getBody();
    }

    public function testGetSubjectNotGenerated()
    {
        $this->twig->expects($this->once())->method('createTemplate')->will($this->throwException(new \Twig_Error('')));

        $this->logger->expects($this->once())->method('error');

        $this->expectException(MailTemplateNotGeneratedException::class);

        $this->mailTemplateRenderer->getSubject();
    }
}
