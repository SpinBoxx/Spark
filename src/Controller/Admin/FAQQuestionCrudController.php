<?php

namespace App\Controller\Admin;

use App\Entity\FAQQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FAQQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FAQQuestion::class;
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
