<?php

namespace Extellient\MailBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Extellient\MailBundle\Entity\Mail;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MailRepository.
 */
class MailRepository extends ServiceEntityRepository
{
    /**
     * MailRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mail::class);
    }

    /**
     * @param null $sendDate
     *
     * @return array
     */
    public function findBySentDate($sendDate = null)
    {
        return parent::findBy([
            'sentDate' => $sendDate,
        ]);
    }
}
