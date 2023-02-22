<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Repository\EventoRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventosController extends AbstractController
{
    private $evento;
    private $security;
    private $user;

    public function __construct(EventoRepository $evento, Security $security, UsuarioRepository $user)
    {
       $this->evento = $evento;
       $this->security = $security;
       $this->user = $user;
    }

    #[Route('/eventos', name: 'app_eventos')]
    public function index(EntityManagerInterface $em): Response
    {
        $evento= new Evento;
        $email= $this->security->getUser()->getUserIdentifier();
        $idarray= $this->user->getUserID($email);
        $id=implode($idarray);

        $eventos=$this->evento->findEventosByID($evento,$id);
        return $this->render('eventos/index.html.twig', [
            'eventos' => $eventos,
            'eventorep' => $this->evento,
            'eventonew' => $evento

        ]);
    }

    #[Route('/eventos/asiste/{idevento}', name: 'app_asiste')]
    public function updateAsiste(int $idevento): Response
    {
        $evento= new Evento;
        $email= $this->security->getUser()->getUserIdentifier();
        $idarray= $this->user->getUserID($email);
        $id=implode($idarray);
        $this->evento->updateAsistencia($evento,true,$id,$idevento);

        return $this->redirectToRoute('app_eventos');
    }

    #[Route('/eventos/noasiste/{idevento}', name: 'app_noasiste')]
    public function updateNoAsiste(int $idevento): Response
    {
        $evento= new Evento;
        $email= $this->security->getUser()->getUserIdentifier();
        $idarray= $this->user->getUserID($email);
        $id=implode($idarray);
        $this->evento->updateAsistencia($evento,false,$id,$idevento);

        return $this->redirectToRoute('app_eventos');
    }
}
