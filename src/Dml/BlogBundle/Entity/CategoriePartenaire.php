<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriePartenaire
 *
 * @ORM\Table(name="dml_categorie_partenaire")
 * @ORM\Entity(repositoryClass="Dml\BlogBundle\Entity\CategoriePartenaireRepository")
 */
class CategoriePartenaire
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
     * @var smallint
     *
     * @ORM\Column(name="priorite", type="smallint")
     */
    private $priorite;

    /**
     * @ORM\OneToMany(targetEntity="Dml\BlogBundle\Entity\Partenaire", mappedBy="categoriePartenaire")
     */
    private $partenaires;

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
     * Set nom
     *
     * @param string $nom
     * @return CategoriePartenaire
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
     * Constructor
     */
    public function __construct()
    {
        $this->partenaires = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add partenaires
     *
     * @param \Dml\BlogBundle\Entity\Partenaire $partenaires
     * @return CategoriePartenaire
     */
    public function addPartenaire(\Dml\BlogBundle\Entity\Partenaire $partenaires)
    {
        $this->partenaires[] = $partenaires;
    
        return $this;
    }

    /**
     * Remove partenaires
     *
     * @param \Dml\BlogBundle\Entity\Partenaire $partenaires
     */
    public function removePartenaire(\Dml\BlogBundle\Entity\Partenaire $partenaires)
    {   
        $this->partenaires->removeElement($partenaires);
    }

    /**
     * Get partenaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartenaires()
    {
        return $this->partenaires;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * Set priorite
     *
     * @param integer $priorite
     * @return CategoriePartenaire
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;
    
        return $this;
    }

    /**
     * Get priorite
     *
     * @return integer 
     */
    public function getPriorite()
    {
        return $this->priorite;
    }
}