<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/crear', name: 'create_product')]
    public function creaProducto(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $c = new Categoria();
        $c->setName("Verduras");

        $product = new Producto();
        $product->setName('Tomate');
        $product->setPrice(2);
        $product->setDescripcion('Brum brum moto moto brum brum');
        $product->setCategoria($c);

        $entityManager->persist($c);
        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Nuevo producto guardado con la ID'.$product->getId());
    }

    #[Route('/product/lee', name: 'create_product')]
    public function buscaProducto(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $c = new Categoria();
        $p=$c->getProductos();
        $res='';

        foreach ($p as $productos) {
            $res.=$productos->getName()."<br>";
        }

        return new Response($res);

    }
}
