<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FLSHR\gestionPublicationBundle\Entity\Ouvrage;
use FLSHR\gestionPublicationBundle\Form\OuvrageType;

/**
 * Ouvrage controller.
 *
 */
class OuvrageController extends Controller {

    public function accueilAction() {
        return $this->render('GestionPublicationBundle:Ouvrage:accueil.html.twig');
    }

    public function afficherProduitsAction() {
        $z = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->findAll();
        return $this->render('GestionPublicationBundle:Ouvrage:listeouvrage.html.twig', array
                    ('ouvrages' => $z,
        ));
    }

    public function indexAction($page = 1) {
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->getOuvrages(8, $page, "stock");
        return $this->render('GestionPublicationBundle:Ouvrage:index.html.twig'
                        , array('entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 8))
        );
    }

    public function afficherOuvrageAction($page = 1) {
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->getOuvrages(12, $page, "stock");
        $z = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->findAll();
        return $this->render('GestionPublicationBundle:Ouvrage:afficheraouvrage.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'ouvrages' => $z,
                    'nombrePage' => ceil(count($entities) / 12))
        );
    }

    public function listeOuvrageAction($page = 1) {
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->getOuvrages(12, $page, "stock");
        return $this->render('GestionPublicationBundle:Ouvrage:resultat.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 12))
        );
    }

    public function listeOuvrageArchiveAction($page = 1) {
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->getOuvrages(12, $page, "archive");
        return $this->render('GestionPublicationBundle:Ouvrage:listeouvrageArchive.html.twig'
                        , array(
                    'entities' => $entities,
                    'page' => $page,
                    'nombrePage' => ceil(count($entities) / 12))
        );
    }

    public function createAction(Request $request) {
        $entity = new Ouvrage();
        $form = $this->createForm(new OuvrageType(), $entity);
        $form->bind($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEtat("stock");
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('ouvrage_afficher', array('page' => 1)));
        }
        return $this->render('GestionPublicationBundle:Ouvrage:nouvelouvrage.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function ajouterOuvrageAction() {
        $entity = new Ouvrage();
        $form = $this->createForm(new OuvrageType(), $entity);
        return $this->render('GestionPublicationBundle:Ouvrage:nouvelouvrage.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function modifierOuvrageAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPublicationBundle:Ouvrage')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ouvrage entity.');
        }
        $editForm = $this->createForm(new OuvrageType(), $entity);
        return $this->render('GestionPublicationBundle:Ouvrage:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    public function mettreAjourOuvrageAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPublicationBundle:Ouvrage')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ouvrage entity.');
        }
        $editForm = $this->createForm(new OuvrageType(), $entity);
        $editForm->bind($request);
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('ouvrage_afficher'));
        }
        return $this->render('GestionPublicationBundle:Ouvrage:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    public function supprimerOuvrageAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionPublicationBundle:Ouvrage')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ouvrage entity.');
        }
        $entity->setEtat("archive");
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('ouvrage_afficher'));
    }

    public function afficheTraceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GestionPublicationBundle:Commande')->findAll();
        return $this->render('GestionPublicationBundle:Ouvrage:afficherTraceOuvrage.html.twig'
                        , array('entities' => $entities,
                    'id' => $id));
    }

    
    
     public function imprimerTraceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GestionPublicationBundle:Commande')->findAll();
        $host = $_SERVER['HTTP_HOST'];
        $chemin = 'http://' . $host;
        $html = $this->render('GestionPublicationBundle:Ouvrage:printTraces.html.twig', array('entities' => $entities, 'chemin' => $chemin , 'id'=>$id));
        $pdfGenerator = $this->get('spraed.pdf.generator');
        return new Response($pdfGenerator->generatePDF($html, 'UTF-8'), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ouvrages.pdf"'
                )
        );
    }
    
    public function imprimerOuvragesAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('GestionPublicationBundle:Ouvrage')->findAll();
        $host = $_SERVER['HTTP_HOST'];
        $chemin = 'http://' . $host;
        $dat = new \Datetime();
        $html = $this->render('GestionPublicationBundle:Ouvrage:printouvrages.html.twig', array('entities' => $entities, 'chemin' => $chemin, 'dat' => $dat));
        $pdfGenerator = $this->get('spraed.pdf.generator');
        return new Response($pdfGenerator->generatePDF($html, 'UTF-8'), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="ouvrages.pdf"'
                )
        );
    }

    public function afficherQteAction() {
        $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->findAll();
        return $this->render('GestionPublicationBundle:Ouvrage:ouvrageQte.html.twig'
                        , array('entities' => $entities));
    }

    public function rechercherAction() {
        $request = $this->container->get('request');
        if ($request->isXmlHttpRequest()) {
            $search_key = $request->request->get('search_keyword');
            $em = $this->container->get('doctrine')->getEntityManager();
            if ($search_key != null) {
                $qb = $em->createQueryBuilder();
                $qb->select('o')
                        ->from('GestionPublicationBundle:Ouvrage', 'o')
                        ->where("o.titre LIKE :motcle and o.etat='stock'")
                        ->orderBy('o.titre', 'ASC')
                        ->setParameter('motcle', $search_key . '%');
                $query = $qb->getQuery();
                $entities = $query->getResult();
                return $this->render('GestionPublicationBundle:Ouvrage:resultat.html.twig', array(
                            'entities' => $entities,
                            'page' => 0,
                            'nombrePage' => 0
                ));
            } else {
                $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Ouvrage')->getOuvrages(2, 1, "stock");
                return $this->render('GestionPublicationBundle:Ouvrage:resultat.html.twig', array(
                            'entities' => $entities,
                            'page' => 1,
                            'nombrePage' => ceil(count($entities) / 2)
                ));
            }
        } else {
            return $this->indexAction();
        }
    }

}