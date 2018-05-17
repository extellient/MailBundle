<?php

namespace Extellient\MailBundle\Exception;

/**
 * Class SenderException.
 */
class MailSenderException extends \Exception
{
    /**
     * MailTemplateNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = 'Mail not send')
    {
        parent::__construct($message);
    }
}
