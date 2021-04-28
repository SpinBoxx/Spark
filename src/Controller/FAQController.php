<?php

namespace App\Controller;

use App\Entity\FAQQuestion;
use App\Entity\FAQTheme;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FAQController extends AbstractController
{


    private $em;

    /**
     * ProductController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    /**
     * @Route("/faq", name="faq")
     */
    public function index(): Response
    {
        $_themes = $this->em->getRepository(FAQTheme::class)->findAll();
        $all_questions = [];
        /** @var FAQTheme $theme */
        foreach ($_themes as $theme){
            $_questions = $this->em->getRepository(FAQQuestion::class)->findBy(['faq_theme' => $theme->getId()]);
            /** @var FAQQuestion $question */
            foreach ($_questions as $question){
                $question_id = $question->getId();
                $all_questions[$theme->getCode()]['questions'] = $question;
                $autocomplete_question[] = ["q" => $question->getQuestion(),"id"=>$question_id];
            }

        }
        return $this->render('faq/index.html.twig', [
            'controller_name' => 'FAQController', 'questions' => $all_questions, "autocomplete_q" => $autocomplete_question,
        ]);
    }
}
