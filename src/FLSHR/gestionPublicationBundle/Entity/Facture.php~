<?php

namespace FLSHR\gestionPublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="FLSHR\gestionPublicationBundle\Entity\FactureRepository")
 * 
 */
class Facture
{
    
    public function __construct() {
        $this->datefacture = new \DateTime();
    }
    
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
     * @ORM\Column(name="datefacture", type="datetime", nullable=true)
     */
    private $datefacture;

    /**
     * @var \Commande
     *
     * @ORM\OneToOne(targetEntity="Commande" , cascade={"persist"})
     */
    private $com;



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
     * Set datefacture
     *
     * @param \DateTime $datefacture
     * @return Facture
     */
    public function setDatefacture($datefacture)
    {
        $this->datefacture = $datefacture;
    
        return $this;
    }

    /**
     * Get datefacture
     *
     * @return \DateTime 
     */
    public function getDatefacture()
    {
        return $this->datefacture;
    }

    /**
     * Set com
     *
     * @param \FLSHR\gestionPublicationBundle\Entity\Commande $com
     * @return Facture
     */
    public function setCom(\FLSHR\gestionPublicationBundle\Entity\Commande $com = null)
    {
        $this->com = $com;
    
        return $this;
    }

    /**
     * Get com
     *
     * @return \FLSHR\gestionPublicationBundle\Entity\Commande 
     */
    public function getCom()
    {
        return $this->com;
    }
}
