<?php

namespace App\Controller;

use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/query/{search}', name: 'app_api')]
    public function index($search, SchoolRepository $schoolRepository): JsonResponse
    {
        $list = $schoolRepository->getSchoolByName($search);

        return new JsonResponse($list);
    }
}