<?php

namespace App\Controller;

use App\Entity\Mesa;
use App\Repository\MesaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MesaApiController extends AbstractController
{
    #[Route('/mesa/api/', name: 'app_mesa_api_add', methods: ['POST'])]
    public function addMesa(Request $request, MesaRepository $mesarep): JsonResponse
    {
        $data=json_decode($request->getContent(),true);
        $anchura=$data['anchura'];
        $longitud=$data['longitud'];
        $x=$data['x'];
        $y=$data['y'];

        $mesa= new Mesa;

        $mesa->setAnchura($anchura);
        $mesa->setLongitud($longitud);
        $mesa->setX($x);
        $mesa->setY($y);

        $mesarep->save($mesa,true);

        return $this->json($data,$status=201);
    }

    #[Route('/mesa/api/{id}', name: 'app_mesa_api_delete', methods:['DELETE'])]
    public function removeMesa(MesaRepository $mesarep, int $id): JsonResponse
    {

        $mesa=$mesarep->findByField($id);
        
        if (!$mesa) {
            "No hay ninguna mesa con esa id";
        }
        else {
            $mesarep->remove($mesa,true);
        }

        return $this->json($status=201);
    }

    #[Route('/mesa/api/', name: 'app_mesa_api_getAll', methods:['GET','HEAD'])]
    public function getMesa(MesaRepository $mesarep): JsonResponse
    {
            $mesas=$mesarep->findAll();

            if ($mesarep) {
                foreach ($mesas as $mesa) {
                    $datos[]=$mesarep->toArray($mesa);
                }
            }
            else {
                "No hay mesas creadas";
            }
            return $this->json($datos,$status=201);
    }

    #[Route('/mesa/api/{id}', name: 'app_mesa_api_getOne', methods:['GET','HEAD'])]
    public function getMesaByID(MesaRepository $mesarep, int $id): JsonResponse
    {
        $mesa=$mesarep->findByField($id);
        
        if (!$mesa) {
            "No hay ninguna mesa con ese id";
        }
        else {
            $datos[]=$mesarep->toArray($mesa);
        }

        return $this->json($datos,$status=201);
    }
}
