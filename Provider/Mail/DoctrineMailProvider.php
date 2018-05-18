<?php

namespace Extellient\MailBundle\Provider\Mail;

use Doctrine\ORM\EntityManagerInterface;
use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Exception\MailerSenderEmptyException;

/**
 * Class MailProviderDoctrine.
 */
class DoctrineMailProvider implements MailProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MailProviderDoctrine constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
        /** @var MailInterface $mail */
        foreach ($mails as $mail) {
            if (empty($mail->getSenderEmail())) {
                throw new MailerSenderEmptyException($mail);
            }

            $this->entityManager->persist($mail);
        }

        //Flush all mails
        $this->entityManager->getUnitOfWork()->commit($mails);
    }

    /**
     * @return MailInterface[]|null
     */
    public function findAllMail()
    {
        return $this->entityManager
            ->getRepository(Mail::class)
            ->findBySentDate();
    }
}
