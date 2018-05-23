<?php

namespace Extellient\MailBundle\Services;

use Extellient\MailBundle\Entity\Mail;

/**
 * Class MailBuilder.
 */
class MailBuilder
{
    /**
     * @var string
     */
    private $mailAddressFrom;
    /**
     * @var string
     */
    private $mailAliasFrom;
    /**
     * @var string
     */
    private $mailReplyTo;

    /**
     * Create an entity Mail with the basic requierement for a mail.
     * Which will return the Mail entity.
     *
     * @param $subject
     * @param $body
     * @param $recipients
     * @param array $attachements
     *
     * @return Mail
     */
    public function createEmail($subject, $body, $recipients, $attachements = [])
    {
        if (!is_array($recipients)) {
            $recipients = [$recipients];
        }

        if (!is_array($attachements)) {
            $attachements = [$attachements];
        }

        $mail = new Mail($subject, $body, $recipients);

        $mail->setSenderEmail($this->mailAddressFrom);

        if (!empty($this->mailAliasFrom)) {
            $mail->setSenderAlias($this->mailAliasFrom);
        }

        if (!empty($this->mailReplyTo)) {
            $mail->setReplyToEmail($this->mailReplyTo);
        }

        $mail->setAttachements($attachements);

        return $mail;
    }

    /**
     * @param string $mailAddressFrom
     */
    public function setMailAddressFrom(string $mailAddressFrom = '')
    {
        $this->mailAddressFrom = $mailAddressFrom;
    }

    /**
     * @param string $mailAliasFrom
     */
    public function setMailAliasFrom(string $mailAliasFrom = '')
    {
        $this->mailAliasFrom = $mailAliasFrom;
    }

    /**
     * @param string $mailReplyTo
     */
    public function setMailReplyTo(string $mailReplyTo = '')
    {
        $this->mailReplyTo = $mailReplyTo;
    }
}
