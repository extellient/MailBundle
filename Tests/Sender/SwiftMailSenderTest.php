<?php

namespace Extellient\MailBundle\Tests\Sender;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Exception\MailSenderException;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Extellient\MailBundle\Sender\SwiftMailSender;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SwiftMailSenderTest extends TestCase
{
    /**
     * @var \Swift_Mailer|MockObject
     */
    private $mailer;
    /**
     * @var MailProviderInterface|MockObject
     */
    private $mailEntityProvider;
    /**
     * @var SwiftMailSender|MockObject
     */
    private $swiftMailerSender;

    protected function setUp()
    {
        parent::setUp();
        $this->mailer = $this->createMock(\Swift_Mailer::class);
        $this->mailEntityProvider = $this->createMock(MailProviderInterface::class);
        $this->swiftMailerSender = new SwiftMailSender($this->mailer, $this->mailEntityProvider);
    }

    public function testInitSwiftMessage()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $mail->setSenderEmail('sender@test.com');
        $mail->setSenderAlias('senderAlias');
        $mail->setAttachement(['test.pdf']);

        $message = $this->swiftMailerSender->initSwiftMessage($mail);

        $this->assertInstanceOf(\Swift_Message::class, $message);
        $this->assertEquals('subject', $message->getSubject());
        $this->assertEquals('body', $message->getBody());
        $this->assertEquals(['recipient@test.com' => null], $message->getTo());
        $this->assertEquals(['sender@test.com' => 'senderAlias'], $message->getFrom());
    }

    public function testSendWithSuccess()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $mail->setSenderEmail('sender@test.com');
        $mail->setSenderAlias('senderAlias');

        $this->mailer->expects($this->once())->method('send')->willReturn(1);

        $sent = $this->swiftMailerSender->send($mail);
        $this->assertEquals(1, $sent);
    }

    public function testSendWithoutSenderEmail()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $this->expectException(\Swift_RfcComplianceException::class);
        $this->swiftMailerSender->send($mail);
    }

    public function testSendWithException()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $mail->setSenderEmail('sender@test.com');
        $mail->setSenderAlias('senderAlias');

        $this->mailer->expects($this->once())->method('send')
            ->willReturnCallback(function ($message, &$failed) {
                $failed = ['test@test.com'];
            });

        $this->expectException(MailSenderException::class);

        $this->swiftMailerSender->send($mail);
    }
}
