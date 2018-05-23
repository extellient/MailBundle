<?php

namespace Extellient\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mail.
 *
 * @ORM\Entity(repositoryClass="Extellient\MailBundle\Repository\MailRepository")
 * @ORM\Table(name="mail")
 */
class Mail implements MailInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=255)
     */
    protected $subject = '';
    /**
     * @var string
     * @ORM\Column(name="body", type="text")
     */
    protected $body = '';
    /**
     * @var string
     * @ORM\Column(name="recipient", type="text")
     */
    protected $recipient = '';
    /**
     * @var string
     * @ORM\Column(name="recipient_copy", type="text", nullable=true)
     */
    protected $recipientCopy = null;
    /**
     * @var string
     * @ORM\Column(name="recipient_hidden_copy", type="text", nullable=true)
     */
    protected $recipientHiddenCopy = null;
    /**
     * @var \DateTime
     * @ORM\Column(name="sent_date", type="datetime", nullable=true)
     */
    protected $sentDate = null;
    /**
     * @var string
     * @ORM\Column(name="attachement", type="text", nullable=true)
     */
    protected $attachements = null;
    /**
     * @var string
     * @ORM\Column(name="sender_alias", type="string", length=255, nullable=true)
     */
    protected $senderAlias = null;
    /**
     * @var string
     * @ORM\Column(name="sender_email", type="string", length=255)
     */
    protected $senderEmail = '';
    /**
     * @var string
     * @ORM\Column(name="reply_to_email", type="string", length=255)
     */
    protected $replyToEmail = '';
    /**
     * @var bool
     * @ORM\Column(name="sent_error", type="boolean")
     */
    protected $sentError = false;
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Mail constructor.
     *
     * @param string $subject
     * @param string $body
     * @param array  $recipients
     */
    public function __construct($subject, $body, array $recipients)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->recipient = implode('|', $recipients);
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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * @param \DateTime $sentDate
     */
    public function setSentDate(\DateTime $sentDate = null)
    {
        $this->sentDate = $sentDate;
    }

    /**
     * @return string
     */
    public function getSenderAlias()
    {
        return $this->senderAlias;
    }

    /**
     * @param string $senderAlias
     */
    public function setSenderAlias($senderAlias)
    {
        $this->senderAlias = $senderAlias;
    }

    /**
     * @return string
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @param string $senderEmail
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;
    }

    /**
     * @return string
     */
    public function getReplyToEmail()
    {
        return $this->replyToEmail;
    }

    /**
     * @param string $replyToEmail
     */
    public function setReplyToEmail($replyToEmail)
    {
        $this->replyToEmail = $replyToEmail;
    }

    /**
     * @return bool
     */
    public function isSentError()
    {
        return $this->sentError;
    }

    /**
     * @param bool $sentError
     */
    public function setSentError(bool $sentError = false)
    {
        $this->sentError = $sentError;
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
     * @return array
     */
    public function getRecipient()
    {
        return empty($this->recipient) ? [] : explode('|', $this->recipient);
    }

    /**
     * @param array $recipient
     */
    public function setRecipient(array $recipient = null)
    {
        $this->recipient = empty($recipient) ? null : implode('|', $recipient);
    }

    /**
     * @param string $recipient
     */
    public function addRecipient(string $recipient)
    {
        $recipients = empty($this->recipient) ? [] : explode('|', $this->recipient);
        $recipients[] = $recipient;

        $this->recipient = implode('|', $recipients);
    }

    /**
     * @return array
     */
    public function getRecipientCopy()
    {
        return empty($this->recipientCopy) ? [] : explode('|', $this->recipientCopy);
    }

    /**
     * @param array $recipientCopy
     */
    public function setRecipientCopy(array $recipientCopy = null)
    {
        $this->recipientCopy = empty($recipientCopy) ? null : implode('|', $recipientCopy);
    }

    /**
     * @param string $recipientCopy
     */
    public function addRecipientCopy(string $recipientCopy)
    {
        $recipients = $this->getRecipientCopy();
        $recipients[] = $recipientCopy;

        $this->recipientCopy = implode('|', $recipients);
    }

    /**
     * @return array
     */
    public function getRecipientHiddenCopy()
    {
        return empty($this->recipientHiddenCopy) ? [] : explode('|', $this->recipientHiddenCopy);
    }

    /**
     * @param array $recipientHiddenCopy
     */
    public function setRecipientHiddenCopy(array $recipientHiddenCopy = null)
    {
        $this->recipientHiddenCopy = empty($recipientHiddenCopy) ? null : implode('|', $recipientHiddenCopy);
    }

    /**
     * @param string $recipientHiddenCopy
     */
    public function addRecipientHiddenCopy($recipientHiddenCopy)
    {
        $recipients = $this->getRecipientHiddenCopy();
        $recipients[] = $recipientHiddenCopy;

        $this->recipientHiddenCopy = implode('|', $recipients);
    }

    /**
     * @return array
     */
    public function getAttachements()
    {
        return empty($this->attachements) ? [] : explode('|', $this->attachements);
    }

    /**
     * @param array $attachements
     */
    public function setAttachements(array $attachements = null)
    {
        $this->attachements = empty($attachements) ? null : implode('|', $attachements);
    }

    /**
     * @param string $attachement
     */
    public function addAttachement(string $attachement)
    {
        $attachements = $this->getAttachements();
        $attachements[] = $attachement;

        $this->attachements[] = implode('|', $attachements);
    }

    /**
     * Update the sent date.
     */
    public function updateSentDate()
    {
        $this->setSentDate(new \DateTime());
    }
}
