<?php

namespace App\Controller\Admin;

use App\Entity\FAQTheme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FAQThemeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FAQTheme::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
