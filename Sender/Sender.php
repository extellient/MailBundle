<?php

namespace Extellient\MailBundle\Sender;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Exception\MailSenderException;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Sender.
 */
class Sender
{
    /**
     * @var MailSenderInterface
     */
    private $mailSender;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var MailProviderInterface
     */
    private $mailEntityProvider;

    /**
     * Sender constructor.
     *
     * @param MailSenderInterface   $mailSender
     * @param LoggerInterface       $logger
     * @param MailProviderInterface $mailEntityProvider
     */
    public function __construct(
        MailSenderInterface $mailSender,
        MailProviderInterface $mailEntityProvider,
        LoggerInterface $logger
    ) {
        $this->mailSender = $mailSender;
        $this->logger = $logger;
        $this->mailEntityProvider = $mailEntityProvider;
    }

    /**
     * Send all mail.
     */
    public function sendAll()
    {
        try {
            $mails = $this->mailEntityProvider->findAllMail();
        } catch (\Exception $e) {
            //It should never happens except if the Doctrine Array is not correct (DC2Type:array)
            $this->logger->critical('Impossible to get mails from database', ['message' => $e->getMessage()]);

            return;
        }

        /** @var MailInterface $mail */
        foreach ($mails as $mail) {
            $this->sendOne($mail);
        }

        $this->mailEntityProvider->save($mails);
    }

    /**
     * Send one mail.
     *
     * @param MailInterface $mail
     */
    public function sendOne(MailInterface $mail)
    {
        try {
            $this->mailSender->send($mail);
            $mail->updateSentDate();
            $this->logger->info('The mail has been sent', $this->getMailLog($mail));
        } catch (MailSenderException $e) {
            $this->logger->error('The mail was not sent', [
                $this->getMailLog($mail),
            ]);
            $mail->setSentError($e->getMessage());
        }
    }

    /**
     * @param MailInterface $mail
     *
     * @return array
     */
    public function getMailLog(MailInterface $mail)
    {
        return [
            'recipients' => $mail->getRecipient(),
            'recipientsCopy' => $mail->getRecipientCopy(),
            'recipentsHiddenCopy' => $mail->getRecipientHiddenCopy(),
            'subject' => $mail->getSubject(),
            'id' => $mail->getId(),
        ];
    }
}
