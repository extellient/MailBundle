<?php

namespace Extellient\MailBundle\Template;

use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotGeneratedException;
use Psr\Log\LoggerInterface;
use Twig_Environment;

/**
 * Class MailTemplateRender.
 */
class MailTemplateRenderer implements MailTemplateRendererInterface
{
    /**
     * @var Twig_Environment
     */
    private $twig;
    /**
     * @var MailTemplate
     */
    private $mailTemplate;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MailTemplateRender constructor.
     *
     * @param Twig_Environment      $twig
     * @param MailTemplateInterface $mailTemplate
     * @param LoggerInterface       $logger
     */
    public function __construct(Twig_Environment $twig, MailTemplateInterface $mailTemplate, LoggerInterface $logger)
    {
        $this->twig = $twig;
        $this->mailTemplate = $mailTemplate;
        $this->logger = $logger;
    }

    /**
     * @param array $variables
     *
     * @return string
     *
     * @throws \Throwable
     */
    public function getBody(array $variables = [])
    {
        try {
            // @codeCoverageIgnoreStart
            // How to test Twig_Template abstract ? TODO
            $baseTemplate = $this->twig->load('@Mail/base.html.twig');
            $bodyTemplate = $this->twig->createTemplate($this->mailTemplate->getMailBody());
            $bodyContent = $bodyTemplate->render($variables);

            return $baseTemplate->render(['body_content' => $bodyContent]);
            // @codeCoverageIgnoreEnd
        } catch (\Twig_Error $e) {
            $this->logger->error('Impossible to generate Mail Body template', $variables);
            throw new MailTemplateNotGeneratedException($e);
        }
    }

    /**
     * @param array $variables
     *
     * @return string
     *
     * @throws MailTemplateNotGeneratedException
     * @throws \Throwable
     */
    public function getSubject(array $variables = [])
    {
        try {
            // @codeCoverageIgnoreStart
            // How to test Twig_Template abstract ? TODO
            $template = $this->twig->createTemplate($this->mailTemplate->getMailSubject());
            return $template->render($variables);
            // @codeCoverageIgnoreEnd
        } catch (\Twig_Error $e) {
            $this->logger->error('Impossible to generate Mail Subject template', $variables);
            throw new MailTemplateNotGeneratedException($e);
        }
    }
}
