<?php

namespace Extellient\MailBundle\Sender;

use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Exception\MailSenderException;

interface MailSenderInterface
{
    /**
     * @param MailInterface $mail
     *
     * @return mixed
     *
     * @throws MailSenderException
     */
    public function send(MailInterface $mail);
}
