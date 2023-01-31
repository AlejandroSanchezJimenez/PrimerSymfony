<?php
namespace App\Controller;
use App\Entity\Producto;
use App\Form\ProductoFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductoFormController extends AbstractController {

    #[Route('/home/formulario/producto', name:"producto_añadido")] 
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $task = new Producto;

        $form = $this->createForm(ProductoFormType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('producto_añadido');
        }
        
        return $this->render('formu.html.twig', [
            'form' => $form,
        ]);
    }
}
?>