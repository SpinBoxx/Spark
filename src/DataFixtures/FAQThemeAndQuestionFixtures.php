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
        foreach ($themes as $key => $theme) {
            $_theme = $manager->getRepository(FAQTheme::class)->findOneBy(['code' => $theme[0]]);
            if (!$_theme instanceof FAQTheme) {
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
                [
                    "q" => "Comment puis-je livrer mes articles",
                    "r" => "La livraison peut être faite avec Chronopost, Colissimo ou Fedex"
                ],
            ],
            "Commandes" => [
                [
                    "q" => "Ma commande n'est pas arrivée",
                    "r" => "Essayer de contacter le vendeur, si vous n'y arriver pas contactez nous"
                ]

            ],
            "Questions techniques" => [
                [
                    "q" => "Je ne peux pas poster d'annonce",
                    "r" => "Verifiez que votre profil est correctement completé"
                ]
            ],
            "Produits" => [
                [
                    "q" => "Quels types de produit puis-je vendre ?",
                    "r" => "Vous pouvez mettre en vente tout type de produits sportif, pour femme, homme et enfant"
                ]
            ],
            "Paiement" => [
                [
                    "q" => "Quels types de paiement sont acceptés",
                    "r" => "Paypal est le seul mode de paiement pris en charge"
                ]
            ],
            "Annonces" => [
                [
                    "q" => "Mon annonce n'apparait plus",
                    "r" => "Si votre annonce n'apparait plus, c'est peut-être qu'elle ne respectait pas notre code de conduite"
                ]
            ],
        ];
        // pour chaque theme
        foreach ($questions as $key_theme => $theme) {
            //pour chaque question
            $_theme = $manager->getRepository(FAQTheme::class)->findOneBy(['label' => $key_theme]);
            foreach ($theme as $key => $pair) {
                /** @var FAQTheme $_theme */
                if (!$_theme instanceof FAQQuestion) {
                    $faq_question = new FAQQuestion();
                    $faq_question->setActive(true);
                    $faq_question->setOrdre($key);
                    $faq_question->setCode("code");
                    $faq_question->setQuestion($pair["q"]);
                    $faq_question->setFaqTheme($_theme);
                    $faq_question->setReponse($pair["r"]);
                    $manager->persist($faq_question);
                }
            }
        }
        $manager->flush();
    }
}
