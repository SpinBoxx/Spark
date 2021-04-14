<?php

namespace App\DataFixtures;

use App\Entity\FAQQuestion;
use App\Entity\FAQTheme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FAQThemeAndQuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $themes = [
            "info" => "Infos et livraisons",
            "commandes" => "Commandes",
            "questions_techniques" => "Questions techniques",
            "produits" => "Produits",
            "paiement" => "Paiement",
            "annonces" => "Annonces"
        ];

        $i = 0;
        foreach ($themes as $key=>$theme){
            $_theme = $manager->getRepository(FAQTheme::class)->findOneBy(['code' => $theme[0]]);
            if(!$_theme instanceof FAQTheme){
                $faq_theme = new FAQTheme();
                $faq_theme->setLabel($theme);
                $faq_theme->setActive(true);
                $faq_theme->setOrdre($i);
                $faq_theme->setCode($key);
                $manager->persist($faq_theme);
                $i++;
            }
        }
        $manager->flush();
        echo "Loaded FAQTheme with success ( $i )!\n";

        $questions = [
            "Infos et livraisons" => [
                "Comment puis-je livrer mes articles",
            ],
            "Commandes" => [
                "Ma commande n'est pas arrivée",
            ],
            "Questions techniques" => [
                "Je ne peux pas poster d'annonce",
            ],
            "Produits" => [
                "Quels types de produit puis-je vendre ?",
            ],
            "Paiement" => [
                "Quels types de paiement sont acceptés",

            ],
            "Annonces" => [
                "Mon annonce n'apparait plus",
            ],


        ];
        // pour chaque theme
        foreach ($questions as $key_theme=>$theme) {
            //pour chaque question
            $_theme = $manager->getRepository(FAQTheme::class)->findOneBy(['label' => $key_theme]);
            foreach ($theme as $key=>$question){
                /** @var FAQTheme $_theme */
                if(!$_theme instanceof FAQQuestion){
                    $faq_theme = new FAQQuestion();
                    $faq_theme->setActive(true);
                    $faq_theme->setOrdre($key);
                    $faq_theme->setCode("code");
                    $faq_theme->setQuestion($question);
                    $faq_theme->setFaqTheme($_theme);
                    $manager->persist($faq_theme);
                }
            }
        }
        $manager->flush();
    }
}
