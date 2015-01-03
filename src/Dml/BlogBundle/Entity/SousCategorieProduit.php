<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategorieProduit
 *
 * @ORM\Table(name="dml_sous_categorie_produit")
 * @ORM\Entity
 */
class SousCategorieProduit
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
     * @ORM\ManyToOne(targetEntity="Dml\BlogBundle\Entity\CategorieProduit", cascade={"persist"})
     * @ORM\JoinColumn(name="categorie_produit_id", nullable=false)
     */
    private $categorieProduit;

    /**
     * @ORM\OneToMany(targetEntity="Dml\BlogBundle\Entity\Produit", mappedBy="sousCategorieProduit")
     */
    private $produits;

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
     * @return Fabricant
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
     * Set categorieProduits
     *
     * @param \Dml\BlogBundle\Entity\CategorieProduit $categorieProduits
     * @return SousCategorieProduit
     */
    public function setCategorieProduit(\Dml\BlogBundle\Entity\CategorieProduit $categorieProduit)
    {
        $this->categorieProduit = $categorieProduit;
    
        return $this;
    }

    /**
     * Get categorieProduits
     *
     * @return \Dml\BlogBundle\Entity\CategorieProduit
     */
    public function getCategorieProduit()
    {
        return $this->categorieProduit;
    }

    public function __toString()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add produits
     *
     * @param \Dml\BlogBundle\Entity\Produit $produits
     * @return SousCategorieProduit
     */
    public function addProduit(\Dml\BlogBundle\Entity\Produit $produits)
    {
        $this->produits[] = $produits;
    
        return $this;
    }

    /**
     * Remove produits
     *
     * @param \Dml\BlogBundle\Entity\Produit $produits
     */
    public function removeProduit(\Dml\BlogBundle\Entity\Produit $produits)
    {
        $this->produits->removeElement($produits);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduits()
    {
        return $this->produits;
    }
}