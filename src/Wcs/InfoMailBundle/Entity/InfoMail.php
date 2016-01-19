<?php

namespace Wcs\InfoMailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * InfoMail
 */
class InfoMail
{
    public function __construct() {
        $this->files = new ArrayCollection();
        $this->uploadedFiles = new ArrayCollection();
    }

    /**
     * @ORM\PreFlush()
     */
    public function upload()
    {

        foreach($this->uploadedFiles as $uploadedFile)
        {
            if ($uploadedFile) {
                $file = new File($uploadedFile);
                $this->getFiles()->add($file);
                $file->setInfoMail($this);
                unset($uploadedFile);
            }
        }
    }

    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * @return ArrayCollection
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }
    /**
     * @param ArrayCollection $uploadedFiles
     */
    public function setUploadedFiles($uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;
    }

    // GENERATED  CODE
    /**
     * @var integer
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $files;


    /**
     * Get id
     *
     * @return integer
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
     * @return InfoMail
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
     * @return InfoMail
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
     * Add file
     *
     * @param \Wcs\InfoMailBundle\Entity\File $file
     *
     * @return InfoMail
     */
    public function addFile(\Wcs\InfoMailBundle\Entity\File $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \Wcs\InfoMailBundle\Entity\File $file
     */
    public function removeFile(\Wcs\InfoMailBundle\Entity\File $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }
    /**
     * @var \Wcs\InfoMailBundle\Entity\TypeMail
     */
    private $typeMail;


    /**
     * Set typeMail
     *
     * @param \Wcs\InfoMailBundle\Entity\TypeMail $typeMail
     *
     * @return InfoMail
     */
    public function setTypeMail(\Wcs\InfoMailBundle\Entity\TypeMail $typeMail = null)
    {
        $this->typeMail = $typeMail;

        return $this;
    }

    /**
     * Get typeMail
     *
     * @return \Wcs\InfoMailBundle\Entity\TypeMail
     */
    public function getTypeMail()
    {
        return $this->typeMail;
    }
}
