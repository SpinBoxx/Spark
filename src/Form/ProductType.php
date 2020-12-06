<?php

namespace App\Form;

use App\Entity\Color;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => true])
            ->add('description',TextareaType::class, ['required' => true])
            ->add('gender', ChoiceType::class, [
                'placeholder' => 'Genre',
                'choices' => [
                    'Homme' => "homme",
                    'Femme' => "femme",
                    'Enfant' => "enfant",
                    'NA' => "na",
                ],
                'required' => true])
            ->add('size', ChoiceType::class, ['placeholder' => 'Taille',
                'choices' => [
                    'Chaussure' => [
                        '20' => '20',
                        '21' => '21',
                    ],
                    'Vêtement' => [
                        'XS' => 'xs',
                        'S' => 's',
                        'M' => 'm',
                        'L' => 'l',
                        'XL' => 'xl',
                    ],
                ],
                'required' => true])
            ->add('brand', ChoiceType::class, ['placeholder' => 'Marque du produit'])
            ->add('quality', ChoiceType::class, ['required' => true, 'placeholder' => 'Qualité du produit'])
            ->add('category', ChoiceType::class, ['required' => true, 'placeholder' => 'Catégorie'])
            ->add('price', MoneyType::class, ['required' => true])
            ->add('color_primary', ColorType::class, ['required' => true])
            ->add('color_secondary', ColorType::class)
            ->add('link', TextType::class)
            ->add('picture_product', FileType::class, [
                'label' => 'Uniquements les fichiers du type .jpg .jpeg .png sont acceptés.',
                'multiple' => true,
                'attr'     => [
                    'accept' => 'image/*',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Déposer mon annonce'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
