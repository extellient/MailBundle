<?php

namespace Extellient\MailBundle\Tests\Sender;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Exception\MailSenderException;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Extellient\MailBundle\Sender\MailSenderInterface;
use Extellient\MailBundle\Sender\Sender;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Class SenderTest.
 */
class SenderTest extends TestCase
{
    /**
     * @var Sender
     */
    private $sender;
    /**
     * @var MailSenderInterface|MockObject
     */
    private $mailSenderInterface;
    /**
     * @var MailProviderInterface|MockObject
     */
    private $mailProviderInterface;
    /**
     * @var LoggerInterface|MockObject
     */
    private $loggerInterface;

    protected function setUp()
    {
        parent::setUp();
        $this->mailSenderInterface = $this->createMock(MailSenderInterface::class);
        $this->mailProviderInterface = $this->createMock(MailProviderInterface::class);
        $this->loggerInterface = $this->createMock(LoggerInterface::class);
        $this->sender = new Sender($this->mailSenderInterface, $this->mailProviderInterface, $this->loggerInterface);
    }

    public function testSendAll()
    {
        $mailCollection = [
            new Mail('subject1', 'body1', ['recipient1@test.com']),
            new Mail('subject2', 'body2', ['recipient2@test.com']),
        ];

        $this->mailProviderInterface->expects($this->once())->method('findAllMail')->willReturn($mailCollection);

        $this->mailProviderInterface->expects($this->once())->method('save')->with($mailCollection);

        $this->sender->sendAll();
    }

    public function testSendAllWithException()
    {
        $this->mailProviderInterface->expects($this->once())->method('findAllMail')->will($this->throwException(new \Exception()));
        $this->loggerInterface->expects($this->once())->method('critical');
        $this->sender->sendAll();
    }

    public function testSendOneWithSuccess()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);

        $this->mailSenderInterface->expects($this->once())->method('send')->with($mail);
        $this->loggerInterface->expects($this->once())->method('info');

        $this->sender->sendOne($mail);
    }

    public function testSendOneWithException()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);

        $this->mailSenderInterface->expects($this->once())->method('send')->will($this->throwException(new MailSenderException()));
        $this->loggerInterface->expects($this->once())->method('error');

        $this->sender->sendOne($mail);
        $this->assertEquals('Mail not send', $mail->getSentError());
    }

    public function testGetMailLog()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $log = $this->sender->getMailLog($mail);
        $this->assertInternalType('array', $log);
        $this->assertCount(5, $log);
        $this->assertArrayHasKey('recipients', $log);
        $this->assertArrayHasKey('recipientsCopy', $log);
        $this->assertArrayHasKey('recipentsHiddenCopy', $log);
        $this->assertArrayHasKey('subject', $log);
        $this->assertArrayHasKey('id', $log);
    }
}
