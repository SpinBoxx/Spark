<?php

namespace App\Controller\Admin;

use App\Entity\FAQQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FAQQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FAQQuestion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("id")->setFormTypeOption('disabled', 'disabled'),
            IntegerField::new("ordre"),
            AssociationField::new('faq_theme'),
            TextField::new("question"),
            TextField::new("reponse"),
            BooleanField::new("active"),
            TextField::new("code"),
        ];
    }
}
