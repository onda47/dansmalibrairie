<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table(name="dml_information")
 * @ORM\Entity
 */
class Information
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
     * @ORM\Column(name="message_bouton", type="string", length=255)
     */
    private $messageBouton;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text")
     */
    private $information;

    /**
     * @var boolean
     *
     * @ORM\Column(name="en_popup", type="boolean")
     */
    private $enPopup;

    /**
     * @var boolean
     *
     * @ORM\Column(name="afficher", type="boolean")
     */
    private $afficher;

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
     * Set messageBouton
     *
     * @param string $messageBouton
     * @return Information
     */
    public function setMessageBouton($messageBouton)
    {
        $this->messageBouton = $messageBouton;

        return $this;
    }

    /**
     * Get messageBouton
     *
     * @return string 
     */
    public function getMessageBouton()
    {
        return $this->messageBouton;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Information
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
     * Set information
     *
     * @param string $information
     * @return Information
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set enPopup
     *
     * @param boolean $enPopup
     * @return Information
     */
    public function setEnPopup($enPopup)
    {
        $this->enPopup = $enPopup;

        return $this;
    }

    /**
     * Get enPopup
     *
     * @return boolean 
     */
    public function getEnPopup()
    {
        return $this->enPopup;
    }

    /**
     * Set afficher
     *
     * @param boolean $afficher
     * @return Information
     */
    public function setAfficher($afficher)
    {
        $this->afficher = $afficher;

        return $this;
    }

    /**
     * Get afficher
     *
     * @return boolean 
     */
    public function getAfficher()
    {
        return $this->afficher;
    }

}
