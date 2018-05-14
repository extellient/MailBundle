<?php

namespace Extellient\MailBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Extellient\MailBundle\Entity\MailTemplate;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MailTemplateRepository.
 */
class MailTemplateRepository extends ServiceEntityRepository
{
    /**
     * MailTemplateRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MailTemplate::class);
    }

    /**
     * @param $code
     *
     * @return null|object
     */
    public function findOneByCode($code)
    {
        return parent::findOneBy([
            'code' => $code,
        ]);
    }
}
