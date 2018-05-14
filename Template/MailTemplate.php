<?php

namespace Extellient\MailBundle\Template;

use Extellient\MailBundle\Exception\MailTemplateNotFoundException;
use Extellient\MailBundle\Provider\Template\MailTemplateProviderInterface;
use Psr\Log\LoggerInterface;
use Twig_Environment;

/**
 * Class Template.
 */
class MailTemplate
{
    /**
     * @var MailTemplateProviderInterface
     */
    private $mailProvider;
    /**
     * @var Twig_Environment
     */
    private $twig;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Template constructor.
     *
     * @param MailTemplateProviderInterface $mailProvider
     * @param Twig_Environment              $twig
     * @param LoggerInterface               $logger
     */
    public function __construct(
        MailTemplateProviderInterface $mailProvider,
        Twig_Environment $twig,
        LoggerInterface $logger
    ) {
        $this->mailProvider = $mailProvider;
        $this->twig = $twig;
        $this->logger = $logger;
    }

    /**
     * Return the rendered mail body from MailTemplate code.
     *
     * @param $code
     *
     * @return MailTemplateRenderer
     *
     * @throws MailTemplateNotFoundException
     */
    public function getTemplate($code)
    {
        $mailTemplate = $this->mailProvider->findOneTemplateByCode($code);

        return new MailTemplateRenderer($this->twig, $mailTemplate, $this->logger);
    }
}
