<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * partenaire
 *
 * @ORM\Table(name="dml_partenaire")
 * @ORM\Entity
 */
class Partenaire
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
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_afficher", type="string", length=255)
     */
    private $lienAfficher;

    /**
    * @ORM\ManyToOne(targetEntity="Dml\BlogBundle\Entity\CategoriePartenaire", inversedBy="partenaires")
    * @ORM\JoinColumn(name="categorie_partenaire_id", nullable=false)
    */
    private $categoriePartenaire;

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
     * Set titre
     *
     * @param string $titre
     * @return partenaire
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return partenaire
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set lienAfficher
     *
     * @param string $lienAfficher
     * @return partenaire
     */
    public function setLienAfficher($lienAfficher)
    {
        $this->lienAfficher = $lienAfficher;
    
        return $this;
    }

    /**
     * Get lienAfficher
     *
     * @return string 
     */
    public function getLienAfficher()
    {
        return $this->lienAfficher;
    }

    /**
     * Set categoriePartenaire
     *
     * @param \Dml\BlogBundle\Entity\CategoriePartenaire $categoriePartenaire
     * @return Partenaire
     */
    public function setCategoriePartenaire(\Dml\BlogBundle\Entity\CategoriePartenaire $categoriePartenaire)
    {
        $this->categoriePartenaire = $categoriePartenaire;
    
        return $this;
    }

    /**
     * Get categoriePartenaire
     *
     * @return \Dml\BlogBundle\Entity\CategoriePartenaire 
     */
    public function getCategoriePartenaire()
    {
        return $this->categoriePartenaire;
    }
}