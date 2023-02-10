<?php
namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\ReservaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

class IndexController extends AbstractController
{
    #[Route('/',name:'landing')]
    public function landing(ReservaRepository $reserva, JuegoDeMesaRepository $juego): Response 
    {
        $reservas= $reserva->findAll();
        $juegos=$juego->findAll();
        return $this->render('index.html.twig', ['reservas' => $reservas, 'juegos' => $juegos]);
    } 

    #[Route('/home')]
    public function request(JuegoDeMesaRepository $juego)
    {
        $juegos=$juego->findAll();
        return new Response(dump($juegos));
    } 

    #[Route('/home/{idioma}&{user}', name:"home")] 
    public function home(String $user=null, String $idioma=null):Response
    {
        if ($idioma=="Español")
        {
            $html = $this->render('homepage.html.twig', ['user' => $user]);
            return $html;
        }
        else if ($idioma=="Ingles")
        {
            die("Welcome ".$user);
        }
        return new Response("Welcome");
    } 

    #[Route('/operador/{operador}&{num1}&{num2}', name:'operador')]
    public function opera(String $operador=null,int $num1=null, int $num2=null):Response
    {
        if ($operador=="suma") {
            $resul=$num1+$num2;
        }
        else if ($operador=="resta") {
            $resul=$num1-$num2;
        }
        else if ($operador=="multiplica") {
            $resul=$num1*$num2;
        }
        else if ($operador=="divide") {
            $resul=$num1/$num2;
        }

        die("El resultado es $resul");
    } 
}
?>