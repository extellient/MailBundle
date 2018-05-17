<?php

namespace Extellient\MailBundle\Exception;

/**
 * Class MailTemplateNotFound.
 */
class MailTemplateNotGeneratedException extends \Exception
{
    /**
     * MailTemplateNotGeneratedException constructor.
     *
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        parent::__construct(
            sprintf('Mail Template has not been generated(%s)', $exception->getMessage()),
            $exception->getCode(),
            $exception
        );
    }
}
