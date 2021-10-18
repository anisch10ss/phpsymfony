<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/{nom}", name="student")
     */
    public function index($nom): Response
    {
        return $this->render('student/index.html.twig', [
            'n'=> $nom,
        ]);
    }
}
