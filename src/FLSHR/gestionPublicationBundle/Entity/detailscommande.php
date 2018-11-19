<?php

namespace FLSHR\gestionPublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * detailscommande
 *
 * @ORM\Table(name="detailscommande")
 * @ORM\Entity
 */
class detailscommande {
    /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="FLSHR\gestionPublicationBundle\Entity\Commande" , inversedBy="detailcomande")
   */
  private $commande;
 
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="FLSHR\gestionPublicationBundle\Entity\Ouvrage" , inversedBy="detailcomande")
   */
  private $ouvrage;
  
  /**
   * @var \integer
   *
   * @ORM\Column(name="qtecommande", type="integer", nullable=true)
   */
  private $qtecommande;
  
    
  
    public function __construct()
    {
        
    }
  
  
    /**
     * Set qtecommande
     *
     * @param integer $qtecommande
     * @return detailscommande
     */
    public function setQtecommande($qtecommande)
    {
        $this->qtecommande = $qtecommande;
    
        return $this;
    }

    /**
     * Get qtecommande
     *
     * @return integer 
     */
    public function getQtecommande()
    {
        return $this->qtecommande;
    }

    /**
     * Set commande
     *
     * @param \FLSHR\gestionPublicationBundle\Entity\Commande $commande
     * @return detailscommande
     */
    public function setCommande(\FLSHR\gestionPublicationBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;
    
        return $this;
    }

    /**
     * Get commande
     *
     * @return \FLSHR\gestionPublicationBundle\Entity\Commande 
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set ouvrage
     *
     * @param \FLSHR\gestionPublicationBundle\Entity\Ouvrage $ouvrage
     * @return detailscommande
     */
    public function setOuvrage(\FLSHR\gestionPublicationBundle\Entity\Ouvrage $ouvrage)
    {
        $this->ouvrage = $ouvrage;
    
        return $this;
    }

    /**
     * Get ouvrage
     *
     * @return \FLSHR\gestionPublicationBundle\Entity\Ouvrage 
     */
    public function getOuvrage()
    {
        return $this->ouvrage;
    }
}
