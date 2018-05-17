<?php

namespace Extellient\MailBundle\Services;

use Extellient\MailBundle\Entity\MailInterface;

interface MailerInterface
{
    /**
     * @param $subject
     * @param $body
     * @param $recipients
     * @param $attachements
     *
     * @return MailInterface
     */
    public function createEmail($subject, $body, $recipients, $attachements);

    /**
     * @return MailInterface
     */
    public function getMail();

    /**
     * @param $mails
     */
    public function save($mails);
}
