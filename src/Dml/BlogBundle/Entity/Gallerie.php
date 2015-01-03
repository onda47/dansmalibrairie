<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallerie
 *
 * @ORM\Table(name="dml_gallerie")
 * @ORM\Entity(repositoryClass="Dml\BlogBundle\Entity\GallerieRepository")
 */
class Gallerie
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="date")
     */
    private $dateAjout;

    /**
     *
     * @ORM\OneToOne(targetEntity="Dml\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id")
     */
    private $image;

    public function __construct()
    {
        $this->dateAjout = new \Datetime();
    }

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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Gallerie
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set image
     *
     * @param \Dml\BlogBundle\Entity\Image $image
     * @return Gallerie
     */
    public function setImage(\Dml\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Dml\BlogBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
