<?php

namespace Wcs\InfoMailBundle\Entity;

/**
 * InfoMail
 */
class InfoMail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $documentsNames;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return MailInfo
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return MailInfo
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set documentsNames
     *
     * @param string $documentsNames
     *
     * @return MailInfo
     */
    public function setDocumentsNames($documentsNames)
    {
        $this->documentsNames = $documentsNames;

        return $this;
    }

    /**
     * Get documentsNames
     *
     * @return string
     */
    public function getDocumentsNames()
    {
        return $this->documentsNames;
    }
}

