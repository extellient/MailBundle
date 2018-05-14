<?php

namespace Extellient\MailBundle\Tests\Services;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Extellient\MailBundle\Services\MailBuilder;
use Extellient\MailBundle\Services\Mailer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class MailerTest.
 */
class MailerTest extends TestCase
{
    /**
     * @var MailProviderInterface|MockObject
     */
    private $mailProviderInterface;
    /**
     * @var Mailer
     */
    private $mailer;

    protected function setUp()
    {
        parent::setUp();

        $this->mailProviderInterface = $this->createMock(MailProviderInterface::class);

        $mailBuilder = new MailBuilder();
        $mailBuilder->setMailAddressFrom('mailAddressFrom@test.com');
        $mailBuilder->setMailAliasFrom('mailAliasFrom@test.com');
        $mailBuilder->setMailReplyTo('mailReplyTo@test.com');

        $this->mailer = new Mailer(
            $this->mailProviderInterface,
            $mailBuilder
        );
    }

    public function testCreateEmail()
    {
        $mail = $this->mailer->createEmail('subject', 'body', 'test@test.com');

        $this->assertEquals('subject', $mail->getSubject());
        $this->assertEquals('body', $mail->getBody());
        $this->assertEquals(['test@test.com'], $mail->getRecipient());
        $this->assertEquals('mailAddressFrom@test.com', $mail->getSenderEmail());
        $this->assertEquals('mailAliasFrom@test.com', $mail->getSenderAlias());
        $this->assertEquals('mailReplyTo@test.com', $mail->getReplyToEmail());
        $this->assertEquals([], $mail->getAttachement());

        $recipArray = $this->mailer->createEmail(
            'subject',
            'body',
            ['test@test.com', 'test2@test.com'],
            'attachement'
        );

        $this->assertEquals(['test@test.com', 'test2@test.com'], $recipArray->getRecipient());
        $this->assertEquals(['attachement'], $recipArray->getAttachement());
    }

    public function testSave()
    {
        $mailCollection = [
            new Mail('subject1', 'body1', ['recipient1@test.com']),
            new Mail('subject2', 'body2', ['recipient2@test.com']),
        ];

        $this->mailProviderInterface->expects($this->once())->method('save')->with($mailCollection);

        $this->mailer->save($mailCollection);
    }
}
