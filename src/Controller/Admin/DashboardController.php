<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\FAQQuestion;
use App\Entity\FAQTheme;
use App\Entity\Quality;
use App\Entity\Size;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Spark');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-arrow-left', 'accueil');
        yield MenuItem::linkToCrud('Marque', 'fas fa-star', Brand::class);
        yield MenuItem::linkToCrud('FAQ Question', 'fas fa-question', FAQQuestion::class);
        yield MenuItem::linkToCrud('FAQ Theme', 'fas fa-brush', FAQTheme::class);
        yield MenuItem::linkToCrud('Qualité', 'fas fa-medal', Quality::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-box', Category::class);
        yield MenuItem::linkToCrud('Taille', 'fas fa-tshirt', Size::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('style/admin/admin.css');
    }
}
