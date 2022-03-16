<?php

namespace App\Controller\Admin;

use App\Entity\Quality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QualityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quality::class;
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
