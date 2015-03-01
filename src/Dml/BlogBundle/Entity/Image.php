<?php

namespace Dml\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="dml_image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @Gedmo\Slug(fields={"alt"})
     * @ORM\Column(type="string", name="slug", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="extension", length=255, nullable=true)
     */
    private $extension;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    private $filenameForRemove;

    private $filenameForRename;

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
     * Set extension
     *
     * @param string $extension
     * @return Document
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Image
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function getNomFichier() {
        return null === $this->extension ? null : $this->slug.'.'.$this->extension;
    }

    public function getAbsoluteChemin()
    {
        return null === $this->extension ? null : $this->getUploadRootDir().'/'.$this->slug.'.'.$this->extension;
    }

    public function getWebChemin()
    {
        return null === $this->extension ? null : $this->getUploadDir().'/'.$this->slug.'.'.$this->extension;
    }

    protected function getUploadRootDir()
    {
        // le extension absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/image';
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->extension = $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du file, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->slug.'.'.$this->extension);

        $this->file = null;
    }

    /**
     * @ORM\PostUpdate()
     */
    public function modifyUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->file->rename($this->fileNameForRename, $this->getUploadRootDir(), $this->slug.'.'.$this->extension);

        unset($this->file);
    }

    /**
     * @ORM\PreUpdate
     */
    public function storeFileNameForRename()
    {
        $this->fileNameForRename = $this->getAbsoluteChemin();
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsoluteChemin();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filenameForRemove) {
            unlink($this->filenameForRemove);
        }
    }
}
