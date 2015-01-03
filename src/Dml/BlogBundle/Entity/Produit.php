<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="dml_produit")
 * @ORM\Entity
 */
class Produit
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
     * @var float
     *
     * @ORM\Column(name="prix", type="decimal", precision=5, scale=2)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="message_flash", type="text", nullable=true)
     */
    private $messageFlash;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=17)
     */
    private $statut;

    /**
     * @ORM\OneToOne(targetEntity="Dml\BlogBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(name="image_id", nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Dml\BlogBundle\Entity\SousCategorieProduit", inversedBy="produits")
     * @ORM\JoinColumn(name="sous_categorie_id", nullable=false)
     */
    private $sousCategorieProduit;

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
     * Set prix
     *
     * @param float $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set fabricant
     *
     * @param string $fabricant
     * @return Produit
     */
    public function setFabricant($fabricant)
    {
        $this->fabricant = $fabricant;

        return $this;
    }

    /**
     * Get fabricant
     *
     * @return string
     */
    public function getFabricant()
    {
        return $this->fabricant;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Produit
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set sousCategorieProduit
     *
     * @param \Dml\BlogBundle\Entity\SousCategorieProduit $sousCategorieProduit
     * @return Produit
     */
    public function setSousCategorieProduit(\Dml\BlogBundle\Entity\SousCategorieProduit $sousCategorieProduit)
    {
        $this->sousCategorieProduit = $sousCategorieProduit;

        return $this;
    }

    /**
     * Get sousCategorieProduit
     *
     * @return \Dml\BlogBundle\Entity\SousCategorieProduit
     */
    public function getSousCategorieProduit()
    {
        return $this->sousCategorieProduit;
    }

    /**
     * Set messageFlash
     *
     * @param string $messageFlash
     * @return Produit
     */
    public function setMessageFlash($messageFlash)
    {
        $this->messageFlash = $messageFlash;

        return $this;
    }

    /**
     * Get messageFlash
     *
     * @return string
     */
    public function getMessageFlash()
    {
        return $this->messageFlash;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Produit
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
