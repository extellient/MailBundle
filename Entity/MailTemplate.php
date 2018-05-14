<?php

namespace Extellient\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MailTemplate.
 *
 * @ORM\Entity(repositoryClass="Extellient\MailBundle\Repository\MailTemplateRepository")
 * @ORM\Table(name="mail_template")
 */
class MailTemplate implements MailTemplateInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt = null;
    /**
     * @var string
     * @ORM\Column(name="mail_subject", type="string", length=255)
     */
    protected $mailSubject = '';
    /**
     * @var string
     * @ORM\Column(name="mail_body", type="text")
     */
    protected $mailBody = '';
    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    protected $code = '';

    /**
     * MailTemplate constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getMailSubject()
    {
        return $this->mailSubject;
    }

    /**
     * @param string $mailSubject
     */
    public function setMailSubject($mailSubject = '')
    {
        $this->mailSubject = $mailSubject;
    }

    /**
     * @return string
     */
    public function getMailBody()
    {
        return $this->mailBody;
    }

    /**
     * @param string $mailBody
     */
    public function setMailBody($mailBody = '')
    {
        $this->mailBody = $mailBody;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }
}
