<?php

namespace FLSHR\gestionPublicationBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CommandeRepository extends EntityRepository {

    public function afficherCommandes($nombreParPage, $page, $usr, $temoin) {
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
        }
        if ($temoin == 1)
            $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where c.reduction<>100");
        else {
            $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where c.user =:usr and c.reduction<>100");
            $query1->setParameter('usr', trim($usr));
        }
        $query1->getResult();
        $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
        return new Paginator($query1);
    }

    public function afficherCommandesDon($nombreParPage, $page, $usr, $temoin) {
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
        }
        if ($temoin == 1)
            $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where c.reduction=100");
        else {
            $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where c.user =:usr and c.reduction=100");
            $query1->setParameter('usr', trim($usr));
        }
        $query1->getResult();
        $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
        return new Paginator($query1);
    }

    //recherche quotidienne
    public function getCommandeByJour($annee, $mois, $jours, $nombreParPage, $page) {

        $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee and substring(c.datecommande,6,2) = :mois and substring(c.datecommande,9,2) = :jours");
        $query1->setParameter('annee', $annee);
        $query1->setParameter('mois', $mois);
        $query1->setParameter('jours', $jours);
        $query1->getResult();
        if ($nombreParPage != 0) {
            if ($page < 1) {
                throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
            }
            $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
            return new Paginator($query1);
        } else {
            return $query1->getResult();
        }
    }

    //recherche hebdomadaire
    public function getCommandeBySemaine($annee, $mois, $semaine, $nombreParPage, $page) {

        $s1 = substr($semaine, 0, 2);
        $s2 = substr($semaine, 3, 2);
        $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee 
                    and substring(c.datecommande,6,2) = :mois
                    and substring(c.datecommande,9,2) between :s1 and :s2");
        $query1->setParameter('annee', $annee);
        $query1->setParameter('mois', $mois);
        $query1->setParameter('s1', $s1);
        $query1->setParameter('s2', $s2);
        if ($nombreParPage != 0) {
            if ($page < 1) {
                throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
            }
            $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
            return new Paginator($query1);
        } else {
            return $query1->getResult();
        }
    }

    //recherche mensuelle
    public function getCommandeByMois($annee, $mois, $nombreParPage, $page) {
        $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee 
                    and substring(c.datecommande,6,2) = :mois ");
        $query1->setParameter('annee', $annee);
        $query1->setParameter('mois', $mois);
        $query1->getResult();
        if ($nombreParPage != 0) {
            if ($page < 1) {
                throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
            }
            $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
            return new Paginator($query1);
        } else {
            return $query1->getResult();
        }
    }

    //recherche annuelle
    public function getCommandeByAnnee($anneeDebut, $anneeFin, $nombreParPage, $page) {
        $query1 = $this->_em->createQuery("select c from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) between :anneeDebut and :anneeFin");
        $query1->setParameter('anneeDebut', $anneeDebut);
        $query1->setParameter('anneeFin', $anneeFin);
        $query1->getResult();
        if ($nombreParPage != 0) {
            if ($page < 1) {
                throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "' . $page . '").');
            }
            $query1->setFirstResult(($page - 1) * $nombreParPage)->setMaxResults($nombreParPage);
            return new Paginator($query1);
        } else {
            return $query1->getResult();
        }
    }

    public function statistiqueParJours($annees, $mois, $temoin) {
        if ($temoin == 0) {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 9, 2) as jour , 
            COUNT(c.id) as nbrC from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee and substring(c.datecommande,6,2) = :mois 
                    GROUP BY jour");
        } else {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 9, 2) as jour , 
            count(d.ouvrage) as nbrO from GestionPublicationBundle:Commande c, 
            GestionPublicationBundle:detailscommande d where 
            c.id=d.commande and substring(c.datecommande , 1, 4)=:annee and
            substring(c.datecommande , 6, 2)=:mois
            GROUP BY jour");
        }
        $query1->setParameter('annee', $annees);
        $query1->setParameter('mois', $mois);
        return $query1->getArrayResult();
    }

    public function statistiqueParSemaine($annees, $mois, $s1, $s2, $temoin) {
        if ($temoin == 0) {
            $query1 = $this->_em->createQuery("select COUNT(c.id) as nbrC from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee and substring(c.datecommande,6,2) = :mois and
                    substring(c.datecommande, 9, 2 ) between :s1 and :s2 ");
        } else {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 9, 2) as jour , 
            count(d.ouvrage) as nbrO from GestionPublicationBundle:Commande c, 
            GestionPublicationBundle:detailscommande d where 
            c.id=d.commande and substring(c.datecommande , 1, 4)=:annee and
            substring(c.datecommande , 6, 2)=:mois and 
            substring(c.datecommande, 9, 2 ) between :s1 and :s2 GROUP BY jour");
        }
        $query1->setParameter('annee', $annees);
        $query1->setParameter('mois', $mois);
        $query1->setParameter('s1', $s1);
        $query1->setParameter('s2', $s2);

        return $query1->getArrayResult();
    }

    public function statistiqueParMois($annees, $temoin) {
        if ($temoin == 0) {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 6, 2) as mois , COUNT(c.id) as nbrC from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) = :annee  
                    GROUP BY mois");
        } else {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 6, 2) as mois , 
            count(d.ouvrage) as nbrO from GestionPublicationBundle:Commande c, 
            GestionPublicationBundle:detailscommande d where 
            c.id=d.commande and substring(c.datecommande , 1, 4)=:annee GROUP BY mois");
        }
        $query1->setParameter('annee', $annees);
        return $query1->getArrayResult();
    }

    public function statistiqueParAnnee($annees_debut, $annees_fin, $temoin) {
        if ($temoin == 0) {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 1, 4) as annee , COUNT(c.id) as nbrC from GestionPublicationBundle:Commande c where 
                    substring(c.datecommande,1,4) between :annee1 and :annee2 group by annee");
        } else {
            $query1 = $this->_em->createQuery("select substring(c.datecommande , 1, 4) as annee , COUNT(d.ouvrage) as nbrO 
            from GestionPublicationBundle:Commande c, GestionPublicationBundle:detailscommande d where c.id=d.commande and
                    substring(c.datecommande,1,4) between :annee1 and :annee2 group by annee");
        }
        $query1->setParameter('annee1', $annees_debut);
        $query1->setParameter('annee2', $annees_fin);
        return $query1->getArrayResult();
    }

}
