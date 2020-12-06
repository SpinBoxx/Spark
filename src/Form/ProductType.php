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
            ->add('title', TextType::class)
            ->add('description',TextareaType::class)
            ->add('picture_product')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Homme' => "homme",
                    'Femme' => "femme",
                    'NA' => "na",
                ]])
            ->add('size', ChoiceType::class)
            ->add('brand', ChoiceType::class)
            ->add('quality', ChoiceType::class)
            ->add('category', ChoiceType::class)
            ->add('price', MoneyType::class)
            ->add('color_primary', ColorType::class)
            ->add('color_secondary', ColorType::class)
            ->add('link', TextType::class)
            ->add('picture_product', FileType::class, [
                'multiple' => true,
                'attr'     => [
                    'accept' => 'image/*',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
