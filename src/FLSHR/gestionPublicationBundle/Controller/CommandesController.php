<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FLSHR\gestionPublicationBundle\Entity\Commande;

class CommandesController extends Controller {

    public function afficherCommandesAction($page = 1) {
        $usr = $this->container->get('security.context')->getToken()->getUser();
        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
            $aide = 1;
        else
            $aide = 0;
        $entities = $this->getDoctrine()
                ->getManager()
                ->getRepository('GestionPublicationBundle:Commande')
                ->afficherCommandes(3, $page, $usr, $aide);

        return $this->render('GestionPublicationBundle:Commande:afficherCommandes.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 3)
        ));
    }

    public function afficherCommandesDonAction($page = 1) {
        $usr = $this->container->get('security.context')->getToken()->getUser();
        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
            $aide = 1;
        else
            $aide = 0;
        $entities = $this->getDoctrine()
                ->getManager()
                ->getRepository('GestionPublicationBundle:Commande')
                ->afficherCommandesDon(3, $page, $usr, $aide);

        return $this->render('GestionPublicationBundle:Commande:afficherCommandes.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 3)
        ));
    }

}