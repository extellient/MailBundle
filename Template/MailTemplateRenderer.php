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
     * @var string|null
     */
    private $baseTemplate;

    /**
     * MailTemplateRender constructor.
     *
     * @param Twig_Environment      $twig
     * @param MailTemplateInterface $mailTemplate
     * @param LoggerInterface       $logger
     * @param string                $baseTemplate
     */
    public function __construct(
        Twig_Environment $twig,
        MailTemplateInterface $mailTemplate,
        LoggerInterface $logger,
        string $baseTemplate = null
    ) {
        $this->twig = $twig;
        $this->mailTemplate = $mailTemplate;
        $this->logger = $logger;
        $this->baseTemplate = $baseTemplate;
    }

    /**
     * @param array $variables
     *
     * @return string
     *
     * @throws MailTemplateNotGeneratedException
     * @throws \Throwable
     */
    public function getBody(array $variables = []): string
    {
        try {
            if (null !== $this->baseTemplate) {
                $baseTemplate = $this->twig->load($this->baseTemplate);
                $bodyContent = $this->renderTemplate($variables);

                return $baseTemplate->render(['body_content' => $bodyContent, 'vars' => $variables]);
            }

            return $this->renderTemplate($variables);
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
    public function getSubject(array $variables = []): string
    {
        try {
            $template = $this->twig->createTemplate($this->mailTemplate->getMailSubject());
            return $template->render($variables);
        } catch (\Twig_Error $e) {
            $this->logger->error('Impossible to generate Mail Subject template', $variables);
            throw new MailTemplateNotGeneratedException($e);
        }
    }

    /**
     * @param array $variables
     *
     * @return string
     *
     * @throws \Throwable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    private function renderTemplate(array $variables = [])
    {
        return $this->twig->createTemplate($this->mailTemplate->getMailBody())->render($variables);
    }
}
