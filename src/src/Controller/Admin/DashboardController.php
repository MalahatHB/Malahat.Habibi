<?php

namespace App\Controller\Admin;

use App\Entity\Attraction;
use App\Entity\Event;
use App\Entity\Hotel;
use App\Entity\Location;
use App\Entity\Message;
use App\Entity\Room;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\Tests\Compiler\E;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotel');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
//        yield MenuItem::section('Hotels');
//        yield MenuItem::linkToCrud('Event', 'fas fa-list', Event::class);
//        yield MenuItem::linkToCrud('Attraction', 'fas fa-list', Attraction::class);
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Menu'),
            MenuItem::linkToCrud('Event', 'fa fa-tags', Event::class),
            MenuItem::linkToCrud('Attraction', 'fa fa-file-text', Attraction::class),
            MenuItem::linkToCrud('Hotel', 'fa fa-file-text', Hotel::class),
            MenuItem::linkToCrud('Location', 'fa fa-file-text', Location::class),
            MenuItem::linkToCrud('Message', 'fa fa-file-text', Message::class),
            MenuItem::linkToCrud('Room', 'fa fa-file-text', Room::class),
            MenuItem::linkToCrud('User', 'fa fa-file-text', User::class),
            ];
    }
}
