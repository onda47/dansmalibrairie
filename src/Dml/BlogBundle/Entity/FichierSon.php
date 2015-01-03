<?php

namespace Dml\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="dml_fichier_son")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FichierSon
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @Gedmo\Slug(fields={"nom"})
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
    public $fichier;

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
     * Sets fichier.
     *
     * @param UploadedFile $fichier
     */
    public function setFichier(UploadedFile $fichier = null)
    {
        $this->fichier = $fichier;
    }

    /**
     * Get fichier.
     *
     * @return UploadedFile
     */
    public function getFichier()
    {
        return $this->fichier;
    }
    /**
     * Set nom
     *
     * @param string $nom
     * @return Image
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
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
        return 'uploads/emission';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->fichier) {
            $this->extension = $this->fichier->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     */
    public function upload()
    {
        if (null === $this->fichier) {
            return;
        }

        // s'il y a une erreur lors du déplacement du file, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->fichier->move($this->getUploadRootDir(), $this->slug.'.'.$this->extension);

        $this->fichier = null;
    }

    /**
     * @ORM\PostUpdate()
     */
    public function modifyUpload()
    {
        if (null === $this->fichier) {
            return;
        }

        $this->fichier->rename($this->fileNameForRename, $this->getUploadRootDir(), $this->slug.'.'.$this->extension);

        unset($this->fichier);
    }

    /**
     * @ORM\PreUpdate()
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
