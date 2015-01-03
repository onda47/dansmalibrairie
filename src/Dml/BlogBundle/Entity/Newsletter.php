<?php

namespace Dml\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="dml_newsletter")
 * @ORM\Entity(repositoryClass="Dml\BlogBundle\Entity\NewsletterRepository")
 */
class Newsletter
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
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="code_html", type="text")
     */
    private $codeHtml;

    public function __construct()
    {
        $this->datePublication = new \Datetime();
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
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Newsletter
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    
        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set codeHtml
     *
     * @param string $codeHtml
     * @return Newsletter
     */
    public function setCodeHtml($codeHtml)
    {
        $this->codeHtml = $codeHtml;
    
        return $this;
    }

    /**
     * Get codeHtml
     *
     * @return string 
     */
    public function getCodeHtml()
    {
        return $this->codeHtml;
    }
}
