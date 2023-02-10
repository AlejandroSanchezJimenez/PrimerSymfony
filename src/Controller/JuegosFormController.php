<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Form\JuegosdeMesaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosFormController extends AbstractController
{
    #[Route('/juegos/añadir', name:"añade_juegos")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $task = new JuegoDeMesa;

        $form = $this->createForm(JuegosdeMesaType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('añade_juegos');
        }
        
        return $this->render('juegos_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
