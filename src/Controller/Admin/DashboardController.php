<?php

namespace App\Controller\Admin;

use App\Entity\Evento;
use App\Entity\JuegoDeMesa;
use App\Entity\Mesa;
use App\Entity\Reserva;
use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("<center><img src='assets/images/logo.png')}}' height=150 width=150><br> Los juegos <span class='text-small'>Hermanos</span></center>")

            ->setFaviconPath('assets/images/logo.png')

            ->setTextDirection('ltr')

            ->renderContentMaximized()

            ->generateRelativeUrls()
        ;
    }
    

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Home', 'fa fa-home', 'landing'),
            MenuItem::subMenu('Base de datos', 'fa-solid fa-database')->setSubItems([
                MenuItem::linkToCrud('Juegos de mesa', 'fa fa-chess-board', JuegoDeMesa::class),
                MenuItem::linkToCrud('Usuarios', 'fa fa-user', Usuario::class),
                MenuItem::linkToCrud('Mesas', 'fa fa-table', Mesa::class),
                MenuItem::linkToCrud('Reservas', 'fa fa-book', Reserva::class),
                MenuItem::linkToCrud('Eventos', 'fa fa-star', Evento::class),
            ]),
            MenuItem::linkToLogout('Logout', 'fa-solid fa-right-from-bracket'),
        ];
    }

}