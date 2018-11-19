<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FLSHR\gestionPublicationBundle\Entity\Facture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FLSHR\gestionPublicationBundle\Entity\Commande;
use FLSHR\gestionPublicationBundle\Entity\detailscommande;
use FLSHR\gestionPublicationBundle\Form\CommandeType;

class FacturesController extends Controller {

    public function afficherFacturesAction($page = 1) {
        $usr = $this->container->get('security.context')->getToken()->getUser();
        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
            $aide = 1;
        else
            $aide = 0;
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Facture')->getFactures(10, $page, $usr, $aide);
        return $this->render('GestionPublicationBundle:Facture:facture.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 10)
                        )
        );
    }

    public function detailfactureAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GestionPublicationBundle:Facture')->find($id);
        return $this->render('GestionPublicationBundle:Facture:detailfacture.html.twig'
                        , array('entities' => $entities)
        );
    }

    //impression factures
    public function imprimerFacturesAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GestionPublicationBundle:Facture')->find($id);

        $host = $_SERVER['HTTP_HOST'];
        $chemin = 'http://' . $host;
        $dat = new \Datetime();

        $html = $this->render('GestionPublicationBundle:Facture:printfactures.html.twig', array('entities' => $entities, 'chemin' => $chemin, 'dat' => $dat));
        $pdfGenerator = $this->get('spraed.pdf.generator');

        return new Response($pdfGenerator->generatePDF($html, 'UTF-8'), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="factures.pdf"'
                )
        );
    }

}

