<?php

namespace Extellient\MailBundle\Services;

use Extellient\MailBundle\Entity\MailInterface;

interface MailerInterface
{
    /**
     * @param $mailSubject
     * @param $mailBody
     * @param $recipients
     * @param $attachements
     *
     * @return MailInterface
     */
    public function createEmail($mailSubject, $mailBody, $recipients, $attachements);

    /**
     * @return MailInterface
     */
    public function getMail();

    /**
     * @param $mails
     */
    public function save($mails);
}
