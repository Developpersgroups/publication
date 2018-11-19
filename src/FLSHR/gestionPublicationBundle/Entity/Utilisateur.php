<?php

namespace FLSHR\gestionPublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
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
     * @var string
     *
     * @ORM\Column(name="typeutilisateur", type="string", length=200, nullable=true)
     */
    private $typeutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=20, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="cne", type="string", length=20, nullable=true)
     */
    private $cne;



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
     * Set typeutilisateur
     *
     * @param string $typeutilisateur
     * @return Utilisateur
     */
    public function setTypeutilisateur($typeutilisateur)
    {
        $this->typeutilisateur = $typeutilisateur;
    
        return $this;
    }

    /**
     * Get typeutilisateur
     *
     * @return string 
     */
    public function getTypeutilisateur()
    {
        return $this->typeutilisateur;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cin
     *
     * @param string $cin
     * @return Utilisateur
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    
        return $this;
    }

    /**
     * Get cin
     *
     * @return string 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set cne
     *
     * @param string $cne
     * @return Utilisateur
     */
    public function setCne($cne)
    {
        $this->cne = $cne;
    
        return $this;
    }

    /**
     * Get cne
     *
     * @return string 
     */
    public function getCne()
    {
        return $this->cne;
    }
}
