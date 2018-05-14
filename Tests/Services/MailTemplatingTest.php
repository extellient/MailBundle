<?php

namespace Extellient\MailBundle\Tests\Services;

use Extellient\MailBundle\Services\Mailer;
use Extellient\MailBundle\Services\MailTemplating;
use Extellient\MailBundle\Template\MailTemplate;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MailTemplatingTest extends TestCase
{
    /**
     * @var MailTemplating
     */
    private $mailTemplating;
    /**
     * @var MailTemplate|MockObject
     */
    private $mailTemplate;
    /**
     * @var Mailer|MockObject
     */
    private $mailer;

    protected function setUp()
    {
        parent::setUp();
        $this->mailTemplate = $this->createMock(MailTemplate::class);
        $this->mailer = $this->createMock(Mailer::class);
        $this->mailTemplating = new MailTemplating($this->mailTemplate, $this->mailer);
    }

    public function testMailService()
    {
        $mailService = $this->mailTemplating->getMailService();
        $this->assertNotNull($mailService);
        $this->assertInstanceOf(Mailer::class, $mailService);
    }
}
