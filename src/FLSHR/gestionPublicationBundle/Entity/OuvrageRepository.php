<?php

namespace FLSHR\gestionPublicationBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OuvrageRepository extends EntityRepository{

  
  public function getOuvrages($nombreParPage, $page , $temoin )
  {
    $query1 = $this->_em->createQuery("select o from GestionPublicationBundle:Ouvrage o where o.etat=:et");
    $query1->setParameter('et', $temoin);
    $query1->getResult();     
    
    $query1->setFirstResult(($page-1) * $nombreParPage)->setMaxResults($nombreParPage);
    return new Paginator($query1);
  }
  
  public function rechercherOuvrage($nombreParPage, $page ,$motcle)
  {
      $em = $this->container->get('doctrine')->getEntityManager();
      $qb = $em->createQueryBuilder();

               $qb->select('o')
                  ->from('GestionPublicationBundle:Ouvrage', 'o')
                  ->where("o.titre LIKE :motcle and o.etat='stock'")
                  ->orderBy('o.titre', 'ASC')
                  ->setParameter('motcle', '%'.$motcle.'%');
 
               $query1 = $qb->getQuery();              
               $query1->getResult();
           
    $query1->setFirstResult(($page-1) * $nombreParPage)->setMaxResults($nombreParPage);
    return new Paginator($query1);
  }
    
}

?>
