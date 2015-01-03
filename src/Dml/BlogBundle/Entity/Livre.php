<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Livre
 *
 * @ORM\Table(name="dml_livre")
 * @ORM\Entity(repositoryClass="Dml\BlogBundle\Entity\LivreRepository")
 */
class Livre
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur_livre", type="string", length=255)
     */
    private $auteurLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="edition", type="string", length=255)
     */
    private $edition;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur_article", type="string", length=255)
     */
    private $auteurArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication_article", type="datetime")
     */
    private $datePublicationArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     */
    private $fonction;

    /**
     *
     * @ORM\OneToOne(targetEntity="Dml\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id")
     */
    private $image;

    public function __construct()
    {
        $this->datePublication = new \Datetime();
        $this->datePublicationArticle = new \Datetime();
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
     * Set titre
     *
     * @param string $titre
     * @return Livre
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
     * Set auteurLivre
     *
     * @param string $auteurLivre
     * @return Livre
     */
    public function setAuteurLivre($auteurLivre)
    {
        $this->auteurLivre = $auteurLivre;
    
        return $this;
    }

    /**
     * Get auteurLivre
     *
     * @return string 
     */
    public function getAuteurLivre()
    {
        return $this->auteurLivre;
    }

    /**
     * Set edition
     *
     * @param string $edition
     * @return Livre
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;
    
        return $this;
    }

    /**
     * Get edition
     *
     * @return string 
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set auteurArticle
     *
     * @param string $auteurArticle
     * @return Livre
     */
    public function setAuteurArticle($auteurArticle)
    {
        $this->auteurArticle = $auteurArticle;
    
        return $this;
    }

    /**
     * Get auteurArticle
     *
     * @return string 
     */
    public function getAuteurArticle()
    {
        return $this->auteurArticle;
    }

    /**
     * Set datePublication
     *
     * @param string $datePublication
     * @return Livre
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return string 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set datePublicationArticle
     *
     * @param \DateTime $datePublicationArticle
     * @return Livre
     */
    public function setDatePublicationArticle($datePublicationArticle)
    {
        $this->datePublicationArticle = $datePublicationArticle;
    
        return $this;
    }

    /**
     * Get datePublicationArticle
     *
     * @return \DateTime 
     */
    public function getDatePublicationArticle()
    {
        return $this->datePublicationArticle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Livre
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Livre
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
     * Set image
     *
     * @param string $image
     * @return Livre
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
     * Set slug
     *
     * @param string $slug
     * @return Livre
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

    /**
     * Set fonction
     *
     * @param string $fonction
     * @return Livre
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    
        return $this;
    }

    /**
     * Get fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->fonction;
    }
}