<?php

namespace App\Form;

use App\Entity\FAQQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FAQQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('question')
            ->add('ordre')
            ->add('active')
            ->add('reponse')
            ->add('faq_theme')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FAQQuestion::class,
        ]);
    }
}
