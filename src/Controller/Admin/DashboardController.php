<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\FAQQuestion;
use App\Entity\FAQTheme;
use App\Entity\Quality;
use App\Entity\Size;
use App\Entity\Sport;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Spark');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-arrow-left', 'homepage');
        yield MenuItem::linkToCrud('Marque', 'fas fa-star', Brand::class);
        yield MenuItem::linkToCrud('FAQ Question', 'fas fa-question', FAQQuestion::class);
        yield MenuItem::linkToCrud('FAQ Theme', 'fas fa-brush', FAQTheme::class);
        yield MenuItem::linkToCrud('Qualité', 'fas fa-medal', Quality::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-box', Category::class);
        yield MenuItem::linkToCrud('Taille', 'fas fa-tshirt', Size::class);
        yield MenuItem::linkToCrud('Sport', 'fas fa-sport', Sport::class);
    }
}
