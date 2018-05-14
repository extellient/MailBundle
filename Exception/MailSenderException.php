<?php

namespace Extellient\MailBundle\Exception;

/**
 * Class SenderException.
 */
class MailSenderException extends \Exception
{
    /**
     * MailTemplateNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('Mail not send');
    }
}
