<?php

namespace App\Controller;

use App\Entity\FAQQuestion;
use App\Form\FAQQuestionType;
use App\Repository\FAQQuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/faq/question")
 */
class AdminFAQQuestionController extends AbstractController
{
    /**
     * @Route("/", name="faq_question_index", methods={"GET"})
     */
    public function index(FAQQuestionRepository $fAQQuestionRepository): Response
    {
        return $this->render('faq_question/index.html.twig', [
            'faq_questions' => $fAQQuestionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="faq_question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fAQQuestion = new FAQQuestion();
        $form = $this->createForm(FAQQuestionType::class, $fAQQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fAQQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('faq_question_index');
        }

        return $this->render('faq_question/new.html.twig', [
            'faq_question' => $fAQQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="faq_question_show", methods={"GET"})
     */
    public function show(FAQQuestion $fAQQuestion): Response
    {
        return $this->render('faq_question/show.html.twig', [
            'faq_question' => $fAQQuestion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="faq_question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FAQQuestion $fAQQuestion): Response
    {
        $form = $this->createForm(FAQQuestionType::class, $fAQQuestion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('faq_question_index');
        }

        return $this->render('faq_question/edit.html.twig', [
            'faq_question' => $fAQQuestion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="faq_question_delete", methods={"POST"})
     */
    public function delete(Request $request, FAQQuestion $fAQQuestion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fAQQuestion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fAQQuestion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('faq_question_index');
    }
}
