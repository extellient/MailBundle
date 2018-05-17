<?php

namespace Extellient\MailBundle\Sender;

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
        } catch (\Exception $exception) {
            //It should be never reach except if doctrine fails to get mails from the database
            $this->logger->critical('Impossible to get mails from database', ['message' => $exception->getMessage()]);

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
            $this->logger->info('The mail has been sent', $this->getLogData($mail));
        } catch (MailSenderException $exception) {
            $this->logger->error($exception->getMessage(), [
                $this->getLogData($mail),
            ]);
            $mail->setSentError(true);
        }
    }

    /**
     * @param MailInterface $mail
     *
     * @return array
     */
    public function getLogData(MailInterface $mail)
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
