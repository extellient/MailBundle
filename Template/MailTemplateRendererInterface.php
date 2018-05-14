<?php

namespace Extellient\MailBundle\Template;

/**
 * Interface MailTemplateRendererInterface.
 */
interface MailTemplateRendererInterface
{
    /**
     * @param array $variables
     *
     * @return string
     */
    public function getBody(array $variables = []);

    /**
     * @param array $variables
     *
     * @return string
     */
    public function getSubject(array $variables = []);
}
