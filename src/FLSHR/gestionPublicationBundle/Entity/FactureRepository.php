<?php
namespace FLSHR\gestionPublicationBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FactureRepository extends EntityRepository{

    
    public function getLastFacture() {
        $query = $this->_em->createQuery('SELECT MAX(f.id) FROM GestionPublicationBundle:Facture f');
        $id = $query->getScalarResult();

        $query1 = $this->_em->createQuery('SELECT f FROM GestionPublicationBundle:Facture f where f.id = :id');
        
        $query1->setParameter('id', $id);
        return $query1->getSingleResult();
    }

    
    public function getFactures($nombreParPage, $page , $usr , $temoin) {
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
        }
        if ($temoin == 1 )
        $query1 = $this->_em->createQuery("select f from GestionPublicationBundle:Facture f order by f.datefacture desc");
        else
        {
        $query1 = $this->createQueryBuilder('f')->join('f.com', 'c','WITH', 'c.user=:usr order by f.datefacture desc')->getQuery();
        $query1->setParameter('usr', trim($usr));
        }
        $query1->getResult();
        $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);

        return new Paginator($query1);
    }

}
