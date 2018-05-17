<?php


namespace Extellient\MailBundle\Exception;

use Extellient\MailBundle\Entity\MailInterface;

/**
 * Class MailerSenderEmptyException
 */
class MailerSenderEmptyException extends MailSenderException
{
    /**
     * Mail Identifier
     * @var MailInterface
     */
    protected $mail;

    /**
     * MailerSenderEmptyException constructor.
     * @param MailInterface|null $mail
     * @param string $message
     */
    public function __construct(MailInterface $mail = null, $message = 'The Mailer has an empty sender_email')
    {
        $this->mail = $mail;
        parent::__construct($message);
    }
}
