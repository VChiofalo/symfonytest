<?php

namespace App\Controller;


use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(SchoolRepository $schoolRepository): Response
    {

        $listSchool = $schoolRepository->findAll();

        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
            'listSchool' => $listSchool
        ]);
    }


    #[Route('/school/{id}', name: 'app_school_details')]
    public function details($id, SchoolRepository $schoolRepository): Response
    {
        $school = $schoolRepository->findOneById($id);

        return $this->render('school/details.html.twig', [
            'school' => $school
        ]);
    }

    #[Route('/schooladd', name: 'app_school_add')]
    public function add(Request $request, SchoolRepository $schoolRepository): Response
    {

        $school = new School();

        $form = $this->createForm(SchoolType::class, $school);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $schoolRepository->save($school, true);
            return $this->redirectToRoute('app_school');
        }

        return $this->render('school/add.html.twig', [
            'formAdd' => $form->createView()
        ]);
    }

    #[Route('/schooledit/{id}', name: 'app_school_edit')]
    public function edit($id, Request $request, SchoolRepository $schoolRepository): Response
    {

        $school = $schoolRepository->findOneById($id);

        $form = $this->createForm(SchoolType::class, $school);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $schoolRepository->save($school, true);
            return $this->redirectToRoute('app_school');
        }

        return $this->render('school/edit.html.twig', [
            'formEdit' => $form->createView()
        ]);
    }

    #[Route('/schoolremove/{id}', name: 'app_school_remove')]
    public function delete($id, SchoolRepository $schoolRepository): Response
    {
        $school = $schoolRepository->findOneById($id);
        $schoolRepository->remove($school, true);

        return $this->redirectToRoute('app_school');
    }
}