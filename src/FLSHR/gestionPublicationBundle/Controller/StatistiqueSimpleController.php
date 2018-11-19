<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FLSHR\gestionPublicationBundle\Entity\Commande;

class StatistiqueSimpleController extends Controller {
 
//page des statistiques simple
    public function statsSimpleAction() {
        return $this->render('GestionPublicationBundle:statistiqueSimple:statistiquessimple.html.twig' , array( 
            'tet' => '0'));
    }
    
    //stats simple quotidienne
    public function submitStatsQuotidienAction($page = 1) {

        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_quotidien');
            $mois = $request->request->get('mois_quotidien');
            $jour = $request->request->get('jours_quotidien');

            $entities = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('GestionPublicationBundle:Commande')
                    ->getCommandeByJour($annees, $mois, $jour, 4, $page);
            
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByJour($annees, $mois, $jour, 0, 2);
            //return new response($annees.$mois.$jour);
            return $this->render('GestionPublicationBundle:statistiqueSimple:resultat.html.twig', array(
                        'entities' => $entities,
                        'page' => $page,
                        'nombrePage' => ceil(count($entities) / 4),
                        'pat' => 'gestion_publication_submit_stats_quotidien',
                        'form' => 'stats_quotidien',
                        'entities1' => $entities1 ,
                        'annee'    => $annees ,
                        'mois'      =>$mois ,
                        'jour'      =>$jour,
                        'temoin'      => 0,
                       
            ));
        }
    }

    //stats simple hebdomadaire
    public function submitStatsHebdomadaireAction($page = 1) {

        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_hebdomadaire');
            $mois = $request->request->get('mois_hebdomadaire');
            $semaine = $request->request->get('semaine_hebdomadaire');

            $entities = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('GestionPublicationBundle:Commande')
                    ->getCommandeBySemaine($annees, $mois, $semaine, 4, $page);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeBySemaine($annees, $mois, $semaine, 0, 2);
            //return new response(' vars loaded : '.$annees.' - '.$mois.' - between '.$semaine);
            return $this->render('GestionPublicationBundle:statistiqueSimple:resultat.html.twig', array('entities' => $entities,
                        'page' => $page,
                        'nombrePage' => ceil(count($entities) / 4),
                        'pat' => 'gestion_publication_submit_stats_hebdomadaire',
                        'form' => 'stats_hebdomadaire',
                        'entities1' => $entities1,
                        'annee'    => $annees ,
                        'mois'      =>$mois ,
                        'semaine'      =>$semaine,
                        'temoin'      => 1,
            ));
        }
    }

    //stats simple mensuel
    public function submitStatsMensuelAction($page = 1) {

        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_mensuel');
            $mois = $request->request->get('mois_mensuel');

            $entities = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('GestionPublicationBundle:Commande')
                    ->getCommandeByMois($annees, $mois, 4, $page);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByMois($annees, $mois, 0, 2);
            //return new response(' vars loaded : '.$annees.' - '.$mois);
            return $this->render('GestionPublicationBundle:statistiqueSimple:resultat.html.twig', array('entities' => $entities,
                        'page' => $page,
                        'nombrePage' => ceil(count($entities) / 4),
                        'pat' => 'gestion_publication_submit_stats_mensuel',
                        'form' => 'stats_mensuel',
                        'entities1' => $entities1,
                        'annee'      =>$annees ,
                        'mois'      =>$mois,
                        'temoin'      => 2,
            ));
        }
    }

    //stats simple annuel
    public function submitStatsAnnuelAction($page = 1) {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $annees_debut = $request->request->get('annees_debut_annuel');
            $annees_fin = $request->request->get('annees_fin_annuel');

            $entities = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('GestionPublicationBundle:Commande')
                    ->getCommandeByAnnee($annees_debut, $annees_fin, 4, $page);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByAnnee($annees_debut, $annees_fin, 0, 2);
            // return new response(' vars loaded : '.$annees_debut.' - '.$annes_fin);
            return $this->render('GestionPublicationBundle:statistiqueSimple:resultat.html.twig', array('entities' => $entities,
                        'page' => $page,
                        'nombrePage' => ceil(count($entities) / 4),
                        'pat' => 'gestion_publication_submit_stats_annuel',
                        'form' => 'stats_annuel',
                        'entities1' => $entities1,
                        'annees_debut'      =>$annees_debut ,
                        'annees_fin'      =>$annees_fin,
                        'temoin'      => 3,
            ));
        }
    }
    
    //imprimer les commandes
    public function imprimerStatsAction($var1 , $var2 , $var3 , $temoin ) {
        $host = $_SERVER['HTTP_HOST'];
        $chemin = 'http://' . $host;
        $dat = new \Datetime();
       // $request = $this->getRequest();

        if ($temoin ==0 ) {
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByJour($var1, $var2, $var3, 0, 2);
        }

        if ($temoin ==1) {
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeBySemaine($var1, $var2, $var3, 0, 2);
        }

        if ($temoin ==2) {
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByMois($var1, $var2, 0, 2);
        }

        if ($temoin ==3) {
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    getCommandeByAnnee($var1, $var2, 0, 2);
        }

        $html = $this->render('GestionPublicationBundle:statistiqueSimple:imprimerCommandes.html.twig', 
                array('entities' => $entities, 'chemin' => $chemin, 'dat' => $dat));
        $pdfGenerator = $this->get('spraed.pdf.generator');

        return new Response($pdfGenerator->generatePDF($html, 'UTF-8'), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="commandes.pdf"'
        ));
    }
}