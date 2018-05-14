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
     * @var array
     * @ORM\Column(name="recipient", type="array")
     */
    protected $recipient = '';
    /**
     * @var array
     * @ORM\Column(name="recipient_copy", type="array")
     */
    protected $recipientCopy = [];
    /**
     * @var array
     * @ORM\Column(name="recipient_hidden_copy", type="array")
     */
    protected $recipientHiddenCopy = [];
    /**
     * @var \DateTime
     * @ORM\Column(name="sent_date", type="datetime", nullable=true)
     */
    protected $sentDate = null;
    /**
     * @var array
     * @ORM\Column(name="attachement", type="array")
     */
    protected $attachement = [];
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
     * @var string
     * @ORM\Column(name="sent_error", type="boolean", nullable=true)
     */
    protected $sentError = null;
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
        $this->recipient = $recipients;
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
     * @return string
     */
    public function getSentError()
    {
        return $this->sentError;
    }

    /**
     * @param string $sentError
     */
    public function setSentError($sentError = null)
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
        return $this->recipient;
    }

    /**
     * @param array $recipient
     */
    public function setRecipient(array $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @param string $recipient
     */
    public function addRecipient($recipient)
    {
        $this->recipient[] = $recipient;
    }

    /**
     * @return array
     */
    public function getRecipientCopy()
    {
        return $this->recipientCopy;
    }

    /**
     * @param array $recipientCopy
     */
    public function setRecipientCopy(array $recipientCopy)
    {
        $this->recipientCopy = $recipientCopy;
    }

    /**
     * @param string $recipientCopy
     */
    public function addRecipientCopy($recipientCopy)
    {
        $this->recipientCopy[] = $recipientCopy;
    }

    /**
     * @return array
     */
    public function getRecipientHiddenCopy()
    {
        return $this->recipientHiddenCopy;
    }

    /**
     * @param array $recipientHiddenCopy
     */
    public function setRecipientHiddenCopy(array $recipientHiddenCopy)
    {
        $this->recipientHiddenCopy = $recipientHiddenCopy;
    }

    /**
     * @param string $recipientHiddenCopy
     */
    public function addRecipientHiddenCopy($recipientHiddenCopy)
    {
        $this->recipientHiddenCopy[] = $recipientHiddenCopy;
    }

    /**
     * @return array
     */
    public function getAttachement()
    {
        return $this->attachement;
    }

    /**
     * @param array $attachement
     */
    public function setAttachement(array $attachement)
    {
        $this->attachement = $attachement;
    }

    /**
     * @param string $attachement
     */
    public function addAttachement($attachement)
    {
        $this->attachement[] = $attachement;
    }

    /**
     * Update the sent date.
     */
    public function updateSentDate()
    {
        $this->setSentDate(new \DateTime());
    }
}
