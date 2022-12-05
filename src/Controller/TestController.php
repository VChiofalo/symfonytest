<?php

namespace App\Controller;

use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\School;

class TestController extends AbstractController
{
    private int $maValeur;

    public function __construct()
    {
        $this->maValeur = 10;
    }

    #[Route('/test/{id}', name: 'app_test')]
    public function index($id, SchoolRepository $schoolRepository): Response
    {
        //Mise à jour d'une table

/*      $laPasserelle = $schoolRepository->findOneById(1);
        $laPasserelle->setAddress('6 rue chaudron');
        $laPasserelle->setPostalCode('75010');
        $laPasserelle->setCity('Paris');

        $schoolRepository->save($laPasserelle, true); */

        //Ajout d'une table

/*      $newSchool = new School;
        $newSchool->setName('W3CAcademie');
        $newSchool->setAddress('1 rue aucune idee');
        $newSchool->setPostalCode('75018');
        $newSchool->setCity('Paris'); 
        
        $schoolRepository->save($newSchool, true); */

/*         $schoolRepository->addSchool('Simplon', '3 rue du killer', '75017', 'Paris', $schoolRepository);

        $listeSchoolByPc = $schoolRepository->searchSchoolByPc('75');
        dd($listeSchoolByPc); */
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'valeurPage' => $this->maValeur 
        ]);
    }

    #[Route('/test_2/{id}', name: 'app_test2')]
    public function page2($id): Response
    {
        return $this->render('test/page2.html.twig', [
            'controller_name' => 'Page 2',
            'valeurPage' => $this->maValeur 
        ]);
    }

    #[Route('/test_3/{id}', name: 'app_test3')]
    public function page3($id): Response
    {
        return $this->render('test/page3.html.twig', [
            'controller_name' => 'Page 3',
            'valeurPage' => $this->maValeur 
        ]);
    }
}
