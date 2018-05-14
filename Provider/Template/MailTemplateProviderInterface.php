<?php

namespace Extellient\MailBundle\Provider\Template;

use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;

interface MailTemplateProviderInterface
{
    /**
     * @param $code
     *
     * @return MailTemplateInterface
     *
     * @throws MailTemplateNotFoundException
     */
    public function findOneTemplateByCode($code);
}
