<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Form\JuegosdeMesaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosFormController extends AbstractController
{
    #[Route('/juegos/añadir', name:"añade_juegos")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $juego = new JuegoDeMesa;

        $form = $this->createForm(JuegosdeMesaType::class, $juego);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $juego = $form->getData();

            try {
                if(!is_dir("Juego_de_mesa_fotos")){
                    mkdir("Juego_de_mesa_fotos");
                }

                move_uploaded_file($form->get('Caratula')->getData(),"Juego_de_mesa_fotos/".$form->get('Caratula')->getData()->getFileName());
                rename("Juego_de_mesa_fotos/".$form->get('Caratula')->getData()->getFileName() , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."caratula".".png");

                move_uploaded_file($form->get('Tablero')->getData(),"Juego_de_mesa_fotos/".$form->get('Tablero')->getData()->getFileName());
                rename("Juego_de_mesa_fotos/".$form->get('Tablero')->getData()->getFileName() , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."tablero".".png");
            }
            catch (IOExceptionInterface $e) {
                echo "Error al intentar cargar la imagen".$e->getPath();
            }

            $em->persist($juego);
            $em->flush();

            return $this->redirectToRoute('app_juegos');
        }
        
        return $this->render('juegos_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
