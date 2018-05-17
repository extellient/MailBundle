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
    private $id;

    /**
     * MailerSenderEmptyException constructor.
     * @param null $id
     * @param string $message
     */
    public function __construct($id = null, $message = 'The Mailer has an empty sender_email')
    {
        $this->id = $id;
        parent::__construct($message);
    }
}
