<?php

namespace Extellient\MailBundle\Provider\Template;

use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;
use Extellient\MailBundle\Repository\MailTemplateRepository;

/**
 * Class MailProviderDoctrine.
 */
class DoctrineMailTemplateProvider implements MailTemplateProviderInterface
{
    /**
     * @var MailTemplateRepository
     */
    private $mailTemplateRepository;

    /**
     * MailProviderDoctrine constructor.
     *
     * @param MailTemplateRepository $mailTemplateRepository
     */
    public function __construct(MailTemplateRepository $mailTemplateRepository)
    {
        $this->mailTemplateRepository = $mailTemplateRepository;
    }

    /**
     * @param $code
     *
     * @return MailTemplateInterface
     *
     * @throws MailTemplateNotFoundException
     */
    public function findOneTemplateByCode($code)
    {
        $mailTemplate = $this->mailTemplateRepository->findOneByCode($code);

        if (!$mailTemplate instanceof MailTemplateInterface) {
            throw new MailTemplateNotFoundException();
        }

        return $mailTemplate;
    }
}
