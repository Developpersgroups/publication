<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FLSHR\gestionPublicationBundle\Entity\Facture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FLSHR\gestionPublicationBundle\Entity\Commande;
use FLSHR\gestionPublicationBundle\Entity\detailscommande;
use FLSHR\gestionPublicationBundle\Form\CommandeType;

class PanierController extends Controller {
    
    public function addPanierAction($id) {
        $em = $this->getDoctrine()->getManager();
        //on définit une session 
        $session = $this->get('session');
        $commande = new Commande();
        $form = $this->createForm(new CommandeType(), $commande);
        $entity = $em->getRepository('GestionPublicationBundle:Ouvrage')->find($id);
        $entities = $session->get('entity');
        $request = $this->getRequest();
        $quantite = $request->request->get('quantite');
        $entity->setQutestocke($quantite);
        if ($quantite != null) {
            if ($entities == null) {
                $entities = array();
                $entities[] = $entity;

                $session->set('entity', $entities);
            } else {
                $aide = 0;
                foreach ($entities as $ouvrage) {
                    if ($ouvrage->getId() == $id) {
                        $aide = 1;
                        $ouvrage->setQutestocke($quantite);
                        break;
                    }
                }
                $session->set('entity', $entities);
                if ($aide == 0) {
                    $entities[] = $entity;
                    $session->set('entity', $entities);
                }
            }
        }
        return $this->render('GestionPublicationBundle:Panier:panier.html.twig', array('entities' => $entities, 'form' => $form->createView()));
    }

    public function AjoutercommandeAction(Request $request) {
        $entity = new Commande();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $entity->setUser($user);
        $form = $this->createForm(new CommandeType(), $entity);
        $form->bind($request);

        $session = $this->get('session');
        $entities = $session->get('entity');


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $facture = new Facture();
            $facture->setCom($entity);
            $em->persist($facture);
            $em->persist($entity);
            $em->flush();

            foreach ($entities as $ouvrage) {
                $em = $this->getDoctrine()->getManager();
                $detail = new detailscommande();
                $ouv = $em->getRepository('GestionPublicationBundle:Ouvrage')->find($ouvrage->getId());
                $detail->setCommande($entity);
                $detail->setOuvrage($ouv);
                $detail->setQtecommande($ouvrage->getQutestocke());
                $ouv->setQutestocke($ouv->getQutestocke() - $ouvrage->getQutestocke());
                $em->persist($detail);
                $em->flush();
            }
            $this->get('session')->set('entity', null);
            return $this->redirect($this->generateUrl('gestion_publication_facture', array('page' => 1)));
        }
        return $this->render('GestionPublicationBundle:Panier:panier.html.twig', array('entities' => $entities, 'form' => $form->createView()));
    }

    //
    public function supprimerProduitAction($id, Request $request) {

        $commande = new Commande();
        $form = $this->createForm(new CommandeType(), $commande);
        $form->bind($request);
        $session = $this->get('session');
        $entities = $session->get('entity');
        $com = 0;
        foreach ($entities as $ouvrage) {
            if ($ouvrage->getId() == $id) {
                unset($entities[$com]);
                $session->set('entity', $entities);
            }
            else
                $com++;
        }
        if (count($entities) == 0) {
            $session->set('entity', null);
            return $this->redirect($this->generateUrl('gestion_publication_liste_ouvrage'));
        }
        $session->set('entity', $entities);
        return $this->render('GestionPublicationBundle:Panier:panier.html.twig', array('entities' => $entities, 'form' => $form->createView()));
    }
    
    //cette fontion annule une commande,on détruit la session 
    public function annulerCommandeAction() {
        $this->get('session')->set('entity', null);
        return $this->render('GestionPublicationBundle:Ouvrage:accueil.html.twig');
    }
    }