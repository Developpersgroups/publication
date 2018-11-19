<?php

namespace FLSHR\gestionPublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FLSHR\gestionPublicationBundle\Entity\Commande;

class StatistiqueGraphiqueController extends Controller {    
//stats  annuel graphique
    public function submitStatsAnnuelGraphiqueAction() {

        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $annees_debut = $request->request->get('annees_debut_annuel_graphique');
            $annees_fin = $request->request->get('annees_fin_annuel_graphique');
            if ($annees_debut > $annees_fin) {
                $reda = $annees_debut;
                $annees_debut = $annees_fin;
                $annees_fin = $reda;
            }
            ///////////////////////////////////////////////////////// khdem hnna
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParAnnee($annees_debut, $annees_fin , 0);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParAnnee($annees_debut, $annees_fin , 1);
            
            for ($z = $annees_debut, $i = 0; $z <= $annees_fin; $z++, $i++) {
                $j = 0; $k = 0;
                foreach ($entities as $entite) {
                    if ($z == $entite['annee']) {
                        $data1[$i] = intval($entite['nbrC']);
                        $j = 1;
                        break;
                    }
                }
                
               foreach ($entities1 as $entite) {
                    if ($z == $entite['annee']) {
                        $data2[$i] = intval($entite['nbrO']);
                        $k = 1;
                        break;
                    }
                }
                
                if ($j == 0) {
                    $data1[$i] = 0;
                }
                if ($k == 0) {
                    $data2[$i] = 0;
                }
            }


            ///////////////////// mat9issch hadchi //////////////////////
            for ($z = 0, $i = $annees_debut; $z < $annees_fin - $annees_debut + 1; $z++, $i++) {
                $xAxe[$z] = $i;
            }
            $highcharts = $this->get('gremo_highcharts');
            $chart = $highcharts->newBarChart()
                    ->newChart()
                    ->setRenderTo('reponse')
                    ->getParent()
                    ->newSeries()
                    ->setName('Commandes')
                    ->setColor('#126AB3')
                    ->setData($data1)
                    ->getParent()
                    ->newSeries()
                    ->setName('Ouvrages')
                    ->setColor('#A5D12C')
                    ->setData($data2)
                    ->getParent()
                    ->newXAxis()
                    ->setCategories($xAxe)
                    ->getParent()
                    ->newYAxis()
                    ->setMin(0)
                    ->newTitle()
                    ->setText('Nombre des commandes')
                    ->getParent()
                    ->getParent()
                    ->newTitle()
                    ->setText("Commandes par années")
                    ->getParent();
            return new response($chart);
        }
    }

    //stats  mensuel graphique
    public function submitStatsMensuelGraphiqueAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_mensuel_graphique');
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->statistiqueParMois($annees , 0);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->statistiqueParMois($annees , 1);

            $tableau = array(01, 02, 03, 04, 05, 06, 07, 08, 09, 08, 09, 10, 11, 12);

            for ($i = 0; $i < count($tableau) - 2; $i++) {
                $j = 0; $k=0 ;
                foreach ($entities as $entite) {
                    if ($tableau[$i] == $entite['mois']) {
                        $data1[$i] = intval($entite['nbrC']);
                        $j = 1;
                        break;
                    }
                }
                
                foreach ($entities1 as $entite) {
                    if ($tableau[$i] == $entite['mois']) {
                        $data2[$i] = intval($entite['nbrO']);
                        $k = 1;
                        break;
                    }
                }
                if ($j == 0) {
                    $data1[$i] = 0;
                }
                 if ($k == 0) {
                    $data2[$i] = 0;
                }
            }

             $highcharts = $this->get('gremo_highcharts');
            $chart = $highcharts->newBarChart()
                    ->newChart()
                    ->setRenderTo('reponse')
                    ->getParent()
                    ->newSeries()
                    ->setName('Commandes')
                    ->setColor('#306904')
                    ->setData($data1)
                    ->getParent()
                    ->newSeries()
                    ->setName('Ouvrages')
                    ->setColor('#A5D12C')
                    ->setData($data2)
                    ->getParent()
                    ->newXAxis()
                    ->setCategories(array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'))
                    ->getParent()
                    ->newYAxis()
                    ->setMin(0)
                    ->newTitle()
                    ->setText('Nombre des commandes')
                    ->getParent()
                    ->getParent()
                    ->newTitle()
                    ->setText("Commandes par mois")
                    ->getParent();
            return new response($chart);
        }
    }

    //stats hebdomadaire graphique
    public function submitStatsHebdomadaireGraphiqueAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_hebdomadaire_graphique');
            $mois = $request->request->get('mois_hebdomadaire_graphique');
            
          
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParSemaine($annees, $mois, "01", "07" , 0);
            $entities1 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParSemaine($annees, $mois, "08", "14" , 0);
            $entities2 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParSemaine($annees, $mois, "15", "21" , 0);
            $entities3 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->
                    statistiqueParSemaine($annees, $mois, "22", "31" , 0);

           
                $data1[0] = intval($entities[0]['nbrC']);
                $data1[1] = intval($entities1[0]['nbrC']);
                $data1[2] = intval($entities2[0]['nbrC']);
                $data1[3] = intval($entities3[0]['nbrC']);
            
                
            
            
            $entities4 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')
                    ->statistiqueParSemaine($annees, $mois, "01", "07" , 1);
            $entities5 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')
                    ->statistiqueParSemaine($annees, $mois, "08", "14" , 1);
            $entities6 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')
                    ->statistiqueParSemaine($annees, $mois, "15", "21" , 1);
            $entities7 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')
                    ->statistiqueParSemaine($annees, $mois, "22", "31" , 1);

            if (count($entities4)==0)
                 $data2[0] = 0 ;
            else
                $data2[0] = intval($entities4[0]['nbrO']);
            
            if (count($entities5)==0)
                 $data2[1] = 0 ;
            else
                $data2[1] = intval($entities5[0]['nbrO']);
            
           if (count($entities6)==0)
                 $data2[2] = 0 ;
            else
                $data2[2] = intval($entities6[0]['nbrO']);
            
            if (count($entities7)==0)
                 $data2[3] = 0 ;
            else
                $data2[3] = intval($entities7[0]['nbrO']);
            
              
            ///////////////////// mat9issch hadchi
            $highcharts = $this->get('gremo_highcharts');
            $chart = $highcharts->newBarChart()
                    ->newChart()
                    ->setRenderTo('reponse')
                    ->getParent()
                    ->newSeries()
                    ->setName('Commandes')
                    ->setColor('#E01B5D')
                    ->setData($data1)
                    ->getParent()
                    ->newSeries()
                    ->setName('Ouvrages')
                    ->setColor('#7903A3')
                    ->setData($data2)
                    ->getParent()
                    ->newXAxis()
                    ->setCategories(array('Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'))
                    ->getParent()
                    ->newYAxis()
                    ->setMin(0)
                    ->newTitle()
                    ->setText('Nombre des commandes')
                    ->getParent()
                    ->getParent()
                    ->newTitle()
                    ->setText("Commandes par semaines")
                    ->getParent();
            return new response($chart);
        }
    }

    
    
    //stats quotidien graphique
    public function submitStatsQuotidienGraphiqueAction() {

        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $annees = $request->request->get('annees_quotidien_graphique');
            $mois = $request->request->get('mois_quotidien_graphique');
            $entities = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->statistiqueParJours($annees, $mois , 0 );
            $entities2 = $this->getDoctrine()->getManager()->getRepository('GestionPublicationBundle:Commande')->statistiqueParJours($annees, $mois , 1 );

            $tableau = array(01, 02, 03, 04, 05, 06, 07, 08, 09, 08, 09, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);

            //pour les commandes par jour
            for ($i = 0; $i < count($tableau) - 2; $i++) {
                $j = 0;
                $k = 0;
                foreach ($entities as $entite) {
                    if ($tableau[$i] == $entite['jour']) {
                        $data1[$i] = intval($entite['nbrC']);
                        $j = 1;
                        break;
                    } 
                }
                    foreach ($entities2 as $entite) {
                    if ($tableau[$i] == $entite['jour']) {
                        $data2[$i] = intval($entite['nbrO']);
                        $k = 1;
                        break;
                    }     
                }
                if ($j == 0) {
                    $data1[$i] = 0;
                }
                if ($k == 0) {
                    $data2[$i] = 0;
                }
            }
            
            
            ///////////////////// mat9issch hadchi
            $highcharts = $this->get('gremo_highcharts');
            $chart = $highcharts->newBarChart()
                    ->newChart()
                    ->setRenderTo('reponse')
                    ->getParent()
                    ->newSeries()
                    ->setName('Ouvrages')
                    ->setColor('red')
                    ->setData($data2)
                    ->getParent()
                    ->newSeries()
                    ->setName('Commandes')
                    ->setColor('orange')
                    ->setData($data1)
                    ->getParent()
                    ->newXAxis()
                    ->setCategories(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31))
                    ->getParent()
                    ->newYAxis()
                    ->setMin(0)
                    ->newTitle()
                    ->setText('Nombre des commandes')
                    ->getParent()
                    ->getParent()
                    ->newTitle()
                    ->setText("Commandes par jours")
                    ->getParent();
            return new response($chart);
        }
    }
    
    //page des statistiques graphiques
    public function statsGraphiqueAction() {
        return $this->render('GestionPublicationBundle:statistiqueGraphique:statistiquesgraphique.html.twig');
    }
    
    
    
    public function testAction()
    {      $motcle = "RABAT";
           $em = $this->container->get('doctrine')->getEntityManager();
                           $qb = $em->createQueryBuilder();
 
               $qb->select('o')
                  ->from('GestionPublicationBundle:Ouvrage', 'o')
                  ->where("o.titre LIKE :motcle")
                  ->orderBy('o.titre', 'ASC')
                  ->setParameter('motcle', $motcle.'%');
 
               $query = $qb->getQuery();              
               $entities = $query->getResult();
            
            
       return $this->render('GestionPublicationBundle:gestionPublication:test.html.twig' , array('entities' =>$entities));
    }
}