<?php

namespace Extellient\MailBundle\Services;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;

/**
 * Class MailService.
 */
class Mailer
{
    /**
     * @var MailProviderInterface
     */
    private $mailProvider;
    /**
     * @var MailBuilder
     */
    private $mailBuilder;

    /**
     * MailService constructor.
     *
     * @param MailProviderInterface $mailProvider
     * @param MailBuilder $mailBuilder
     */
    public function __construct(MailProviderInterface $mailProvider, MailBuilder $mailBuilder)
    {
        $this->mailProvider = $mailProvider;
        $this->mailBuilder = $mailBuilder;
    }

    /**
     * Create an entity Mail with the basic requierement for a mail.
     *
     * @param $mailSubject
     * @param $mailBody
     * @param $recipients
     * @param array $attachements
     *
     * @return Mail
     */
    public function createEmail($mailSubject, $mailBody, $recipients, $attachements = [])
    {
        return $this->mailBuilder->createEmail($mailSubject, $mailBody, $recipients, $attachements);
    }

    /**
     * Flush the Mail.
     *
     * @param $mails
     */
    public function save($mails)
    {
        $this->mailProvider->save($mails);
    }
}
