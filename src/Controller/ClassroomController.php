<?php

namespace App\Controller;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClubRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    /**
     
     *@Route("/AfficheC" , name="Affiche")
    */
    public function Affiche(ClubRepository $repo){
     //   $repo=$this->getDoctrine()->getRepository(Classroom::class);
        $classroom=$repo->findAll();
        return $this->render('classroom/Affiche.html.twig',
        ['classroom'=>$classroom]);
    }
       /**
     
     *@Route("/Delete/{id}" , name="delete")
    */
    public function delete($id, ClubRepository $repo){
     //   $objSup=$this->getDoctrine()->getRepository(Classroom::class)->find($id);
      $classroom=$repo->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute('Affiche');
    }
     /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response 
     *@Route("/classroom/Add" , name="add")
    */
     function add(Request $request){
        $classroom=new Classroom();
        $form=$this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        $form->add('Ajouter', SubmitType::class);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
        }
        return $this->render('classroom/Add.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
