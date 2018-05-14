<?php

namespace Extellient\MailBundle\Sender;

use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Exception\MailSenderException;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;

/**
 * Class MailSenderService.
 */
class SwiftMailSender implements MailSenderInterface
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var MailProviderInterface
     */
    private $mailEntityProvider;

    /**
     * MailSenderService constructor.
     *
     * @param Swift_Mailer          $mailer
     * @param MailProviderInterface $mailEntityProvider
     */
    public function __construct(Swift_Mailer $mailer, MailProviderInterface $mailEntityProvider)
    {
        $this->mailer = $mailer;
        $this->mailEntityProvider = $mailEntityProvider;
    }

    /**
     * @param MailInterface $mail
     *
     * @return Swift_Message
     */
    public function initSwiftMessage(MailInterface $mail)
    {
        $message = (new Swift_Message($mail->getSubject()))
            ->setFrom([$mail->getSenderEmail() => $mail->getSenderAlias()])
            ->setTo($mail->getRecipient())
            ->setBody($mail->getBody(), 'text/html')
            ->setCc($mail->getRecipientCopy())
            ->setBcc($mail->getRecipientHiddenCopy())
        ;

        foreach ($mail->getAttachement() as $attchement) {
            $message->attach(Swift_Attachment::fromPath($attchement));
        }

        return $message;
    }

    /**
     * @param MailInterface $mail
     *
     * @return int
     *
     * @throws MailSenderException
     */
    public function send(MailInterface $mail)
    {
        $failedRecipient = [];

        $message = $this->initSwiftMessage($mail);

        $sent = $this->mailer->send($message, $failedRecipient);

        if (!empty($failedRecipient)) {
            throw new MailSenderException();
        }

        return $sent;
    }
}
