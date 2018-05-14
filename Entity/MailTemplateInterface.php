<?php

namespace Extellient\MailBundle\Entity;

/**
 * Interface MailTemplateInterface.
 */
interface MailTemplateInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param mixed $id
     */
    public function setId($id);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null);

    /**
     * @return string
     */
    public function getMailSubject();

    /**
     * @param string $mailSubject
     */
    public function setMailSubject($mailSubject = '');

    /**
     * @return string
     */
    public function getMailBody();

    /**
     * @param string $mailBody
     */
    public function setMailBody($mailBody = '');

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function __toString();
}
