<?php

namespace Extellient\MailBundle\Services;

use Extellient\MailBundle\Template\MailTemplate;

/**
 * Class MailManagerService.
 */
class MailTemplating implements MailTemplatingInterface
{
    /**
     * @var Mailer
     */
    private $mailService;
    /**
     * @var MailTemplate
     */
    private $mailTemplate;

    /**
     * MailManagerService constructor.
     *
     * @param MailTemplate $mailTemplate
     * @param Mailer       $mailService
     */
    public function __construct(MailTemplate $mailTemplate, Mailer $mailService)
    {
        $this->mailService = $mailService;
        $this->mailTemplate = $mailTemplate;
    }

    /**
     * Create an entity Mail with the basic requierement for a mail from a MailTemplate name
     * Which will return the Mail entity
     *
     * @param string       $templateCode
     * @param array|string $recipients
     * @param array        $variables
     * @param array|string $attachements
     *
     * @return \Extellient\MailBundle\Entity\MailInterface
     *
     * @throws \Extellient\MailBundle\Exception\MailTemplateNotFoundException
     * @throws \Extellient\MailBundle\Exception\MailTemplateNotGeneratedException
     * @throws \Throwable
     */
    public function createEmail(
        $templateCode,
        $recipients,
        array $variables = [],
        $attachements = []
    ) {
        $template = $this->mailTemplate->getTemplate($templateCode);

        return $this->mailService->createEmail(
            $template->getSubject($variables),
            $template->getBody($variables),
            $recipients,
            $attachements
        );
    }

    /**
     * @return Mailer
     */
    public function getMailService()
    {
        return $this->mailService;
    }
}
