<?php

namespace Extellient\MailBundle\Provider\Mail;

use Doctrine\ORM\EntityManagerInterface;
use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailInterface;

/**
 * Class MailProviderDoctrine.
 */
class DoctrineMailProvider implements MailProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * MailProviderDoctrine constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Save all mails to the database.
     *
     * @param $mails
     */
    public function save($mails)
    {
        if (!is_array($mails)) {
            $mails = [$mails];
        }

        //Persist all mails
        foreach ($mails as $mail) {
            $this->em->persist($mail);
        }

        //Flush all mails
        $this->em->getUnitOfWork()->commit($mails);
    }

    /**
     * @return MailInterface[]|null
     */
    public function findAllMail()
    {
        return $this->em
            ->getRepository(Mail::class)
            ->findBySentDate();
    }
}
