<?php

namespace FLSHR\gestionPublicationBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;


/**
 * Ouvrage
 *
 * @ORM\Table(name="ouvrage")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="FLSHR\gestionPublicationBundle\Entity\OuvrageRepository")
 */
class Ouvrage
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
     * @ORM\Column(name="titre", type="string", length=1024, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=1024, nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="editeur", type="string", length=1024, nullable=true)
     */
    private $editeur;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=1024, nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="impression", type="string", length=254, nullable=true)
     */
    private $impression;

    /**
     * @var string
     *
     * @ORM\Column(name="depot_legal", type="string", length=1024, nullable=true)
     */
    private $depotLegal;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=254, nullable=true)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="issn", type="string", length=254, nullable=true)
     */
    private $issn;

    /**
     * @var string
     *
     * @ORM\Column(name="edition", type="string", length=254, nullable=true)
     */
    private $edition;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="decimal", nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="qutestocke", type="integer", nullable=true)
     */
    private $qutestocke;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=254, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="descrption", type="string", length=1024, nullable=true)
     */
    private $descrption;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="dateentree", type="date", nullable=true)
     */
    private $dateentree;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=254, nullable=true)
     */
     private $etat;
     
    /**
    * @ORM\OneToMany(targetEntity="FLSHR\GestionPublicationBundle\Entity\detailscommande" ,mappedBy="ouvrage")
    */
    private $detailcomande;
    
    
    private $file;
     
    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;
  

    // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
    public function setFile(UploadedFile $file)
     {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->photo) {
          // On sauvegarde l'extension du fichier pour le supprimer plus tard
          $this->tempFilename = $this->photo;

          // On réinitialise les valeurs des attributs url et alt
          $this->photo = null;
        }
     }
     
     public function getFile()
     {
         return $this->file ;
     }


     /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */
   public function preUpload()
   {
     // Si jamais il n'y a pas de fichier (champ facultatif)
     if (null === $this->file) {
       return;
     }

     // Le nom du fichier est son id, on doit juste stocker également son extension
     // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
     //$this->photo = $this->file->guessExtension();

     // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'internaute
     $this->photo = $this->file->getClientOriginalName();
   }
     
  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }
 
    // Si on avait un ancien fichier, on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'_'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }
 
    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le répertoire de destination
      $this->id.'_'.$this->photo   // Le nom du fichier à créer, ici « id.extension »
    );
  }
  
  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'_'.$this->photo;
  }
 
  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }
  
      public function getWebPath()
        {
          return $this->getUploadDir().'/'.$this->getId().'_'.$this->getPhoto();
        }
  
    /**
     * Constructor
     */
    public function __construct()
    {
         $this->detailcomande = new \Doctrine\Common\Collections\ArrayCollection();
    }
   
 
  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur
    return 'uploads/img';
  }
 
  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
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
     * @return Ouvrage
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
     * Set auteur
     *
     * @param string $auteur
     * @return Ouvrage
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set editeur
     *
     * @param string $editeur
     * @return Ouvrage
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;
    
        return $this;
    }

    /**
     * Get editeur
     *
     * @return string 
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set serie
     *
     * @param string $serie
     * @return Ouvrage
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set impression
     *
     * @param string $impression
     * @return Ouvrage
     */
    public function setImpression($impression)
    {
        $this->impression = $impression;
    
        return $this;
    }

    /**
     * Get impression
     *
     * @return string 
     */
    public function getImpression()
    {
        return $this->impression;
    }

    /**
     * Set depotLegal
     *
     * @param string $depotLegal
     * @return Ouvrage
     */
    public function setDepotLegal($depotLegal)
    {
        $this->depotLegal = $depotLegal;
    
        return $this;
    }

    /**
     * Get depotLegal
     *
     * @return string 
     */
    public function getDepotLegal()
    {
        return $this->depotLegal;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Ouvrage
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    
        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set issn
     *
     * @param string $issn
     * @return Ouvrage
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;
    
        return $this;
    }

    /**
     * Get issn
     *
     * @return string 
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Set edition
     *
     * @param string $edition
     * @return Ouvrage
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
     * Set prix
     *
     * @param float $prix
     * @return Ouvrage
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
     * Set qutestocke
     *
     * @param integer $qutestocke
     * @return Ouvrage
     */
    public function setQutestocke($qutestocke)
    {
        $this->qutestocke = $qutestocke;
    
        return $this;
    }

    /**
     * Get qutestocke
     *
     * @return integer 
     */
    public function getQutestocke()
    {
        return $this->qutestocke;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Ouvrage
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set descrption
     *
     * @param string $descrption
     * @return Ouvrage
     */
    public function setDescrption($descrption)
    {
        $this->descrption = $descrption;
    
        return $this;
    }

    /**
     * Get descrption
     *
     * @return string 
     */
    public function getDescrption()
    {
        return $this->descrption;
    }


    

    /**
     * Set dateentree
     *
     * @param \DateTime $dateentree
     * @return Ouvrage
     */
    public function setDateentree($dateentree)
    {
        $this->dateentree = $dateentree;

        return $this;
    }

    /**
     * Get dateentree
     *
     * @return \DateTime 
     */
    public function getDateentree()
    {
        return $this->dateentree;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Ouvrage
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Add detailcomande
     *
     * @param \FLSHR\GestionPublicationBundle\Entity\detailscommande $detailcomande
     * @return Ouvrage
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
}
