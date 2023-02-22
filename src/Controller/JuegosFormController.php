<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Form\JuegosdeMesaType;
use App\Repository\JuegoDeMesaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosFormController extends AbstractController
{
    private $juegorep;

    public function __construct(JuegoDeMesaRepository $juegorep)
    {
       $this->juegorep = $juegorep;
    }

    #[Route('/juegos/añadir', name:"añade_juegos")]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $juego = new JuegoDeMesa;

        $form = $this->createForm(JuegosdeMesaType::class, $juego);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
        
        return $this->render('añadejuegos/index.html.twig', [
            'form' => $form->createView(),
            'juegoedit' => null
        ]);
    }

    #[Route('/juegos/edit/{id}', name: 'product_edit')]
    public function update(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(JuegoDeMesa::class)->find($id);
        $form = $this->createForm(JuegosdeMesaType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if (!$product) {
                throw $this->createNotFoundException(
                    'No existe ningún juego con la id '.$id
                );
            }

            rename("Juego_de_mesa_fotos/".$product->getNombre()."caratula".".png" , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."caratula".".png");
            rename("Juego_de_mesa_fotos/".$product->getNombre()."tablero".".png" , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."tablero".".png");

            $product->setNombre($form->get('Nombre')->getData());
            $product->setEditorial($form->get('Editorial')->getData());
            $product->setAnchura($form->get('Anchura')->getData());
            $product->setLongitud($form->get('Longitud')->getData());
            $product->setMinJug($form->get('Min_jug')->getData());
            $product->setMaxJug($form->get('Max_jug')->getData());

            if ($form->get('Caratula')->getData()) {
                try {
                    if(!is_dir("Juego_de_mesa_fotos")){
                        mkdir("Juego_de_mesa_fotos");
                    }
                    
                    $product->setCaratula($form->get('Caratula')->getData());
                    move_uploaded_file($form->get('Caratula')->getData(),"Juego_de_mesa_fotos/".$form->get('Caratula')->getData()->getFileName());
                    rename("Juego_de_mesa_fotos/".$form->get('Caratula')->getData()->getFileName() , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."caratula".".png");
                }
                catch (IOExceptionInterface $e) {
                    echo "Error al intentar cargar la imagen".$e->getPath();
                }
            }     
            
            if ($form->get('Tablero')->getData()) {
                try {
                    if(!is_dir("Juego_de_mesa_fotos")){
                        mkdir("Juego_de_mesa_fotos");
                    }
                    
                    $product->setCaratula($form->get('Tablero')->getData());
                    move_uploaded_file($form->get('Tablero')->getData(),"Juego_de_mesa_fotos/".$form->get('Tablero')->getData()->getFileName());
                    rename("Juego_de_mesa_fotos/".$form->get('Tablero')->getData()->getFileName() , "Juego_de_mesa_fotos/".$form->get('Nombre')->getData()."tablero".".png");
                }
                catch (IOExceptionInterface $e) {
                    echo "Error al intentar cargar la imagen".$e->getPath();
                }
            }     

            $entityManager->flush();

            return $this->redirectToRoute('app_juegos');
        }

            return $this->render('añadejuegos/index.html.twig', [
                'form' => $form->createView(),
                'juegoedit' => $product
            ]);
    }

    #[Route('/juegos/delete/{id}', name: 'product_delete')]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(JuegoDeMesa::class)->find($id);

        unlink('Juego_de_mesa_fotos/'.$product->getNombre()."caratula".".png");
        unlink('Juego_de_mesa_fotos/'.$product->getNombre()."tablero".".png");
        
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('app_juegos');
    }
}
