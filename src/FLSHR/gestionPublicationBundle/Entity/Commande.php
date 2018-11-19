<?php

namespace FLSHR\gestionPublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="FLSHR\gestionPublicationBundle\Entity\CommandeRepository")
 */
class Commande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecommande", type="date", nullable=true)
     */
    private $datecommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="reduction", type="integer", nullable=true)
     */
    private $reduction;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=254, nullable=true)
     */
    private $user;


    /**
     * @var \Utilisateur
     *
     * @ORM\OneToOne(targetEntity="Utilisateur" , cascade={"persist"})
     */
    private $uti;

    /**
    * @ORM\OneToMany(targetEntity="FLSHR\GestionPublicationBundle\Entity\detailscommande",mappedBy="commande")
    */
    private $detailcomande;

    
    

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
     * Set datecommande
     *
     * @param \DateTime $datecommande
     * @return Commande
     */
    public function setDatecommande($datecommande)
    {
        $this->datecommande = $datecommande;
    
        return $this;
    }

    /**
     * Get datecommande
     *
     * @return \DateTime 
     */
    public function getDatecommande()
    {
        return $this->datecommande;
    }

    /**
     * Set reduction
     *
     * @param integer $reduction
     * @return Commande
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
    
        return $this;
    }

    /**
     * Get reduction
     *
     * @return integer 
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set uti
     *
     * @param \FLSHR\gestionPublicationBundle\Entity\Utilisateur $uti
     * @return Commande
     */
    public function setUti(\FLSHR\gestionPublicationBundle\Entity\Utilisateur $uti = null)
    {
        $this->uti = $uti;
    
        return $this;
    }

    /**
     * Get uti
     *
     * @return \FLSHR\gestionPublicationBundle\Entity\Utilisateur 
     */
    public function getUti()
    {
        return $this->uti;
    }
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detailcomande = new \Doctrine\Common\Collections\ArrayCollection();
        $this->datecommande = new \Datetime();
    }

    /**
     * Add detailcomande
     *
     * @param \FLSHR\GestionPublicationBundle\Entity\detailscommande $detailcomande
     * @return Commande
     */
    public function addDetailcomande(\FLSHR\GestionPublicationBundle\Entity\detailscommande $detailcomande)
    {
        $this->detailcomande[] = $detailcomande;

        return $this;
    }

    /**
     * Remove detailcomande
     *
     * @param \FLSHR\GestionPublicationBundle\Entity\detailscommande $detailcomande
     */
    public function removeDetailcomande(\FLSHR\GestionPublicationBundle\Entity\detailscommande $detailcomande)
    {
        $this->detailcomande->removeElement($detailcomande);
    }

    /**
     * Get detailcomande
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetailcomande()
    {
        return $this->detailcomande;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Commande
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
}
