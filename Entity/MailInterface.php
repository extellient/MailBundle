<?php

namespace Extellient\MailBundle\Entity;

/**
 * Interface MailInterface.
 */
interface MailInterface
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
     * @return string
     */
    public function getSubject();

    /**
     * @param string $subject
     */
    public function setSubject($subject);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @param string $body
     */
    public function setBody($body);

    /**
     * @return \DateTime
     */
    public function getSentDate();

    /**
     * @param \DateTime $sentDate
     */
    public function setSentDate(\DateTime $sentDate = null);

    /**
     * @return string
     */
    public function getSenderAlias();

    /**
     * @param string $senderAlias
     */
    public function setSenderAlias($senderAlias);

    /**
     * @return string
     */
    public function getSenderEmail();

    /**
     * @param string $senderEmail
     */
    public function setSenderEmail($senderEmail);

    /**
     * @return string
     */
    public function getReplyToEmail();

    /**
     * @param string $replyToEmail
     */
    public function setReplyToEmail($replyToEmail);

    /**
     * @return string
     */
    public function getSentError();

    /**
     * @param string $sentError
     */
    public function setSentError($sentError = null);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return array
     */
    public function getRecipient();

    /**
     * @param array $recipient
     */
    public function setRecipient(array $recipient);

    /**
     * @return array
     */
    public function getRecipientCopy();

    /**
     * @param array $recipientCopy
     */
    public function setRecipientCopy(array $recipientCopy);

    /**
     * @param string $recipientCopy
     */
    public function addRecipientCopy($recipientCopy);

    /**
     * @return array
     */
    public function getRecipientHiddenCopy();

    /**
     * @param array $recipientHiddenCopy
     */
    public function setRecipientHiddenCopy(array $recipientHiddenCopy);

    /**
     * @param string $recipientHiddenCopy
     */
    public function addRecipientHiddenCopy($recipientHiddenCopy);

    /**
     * @return array
     */
    public function getAttachement();

    /**
     * @param array $attachement
     */
    public function setAttachement(array $attachement);

    public function updateSentDate();
}
