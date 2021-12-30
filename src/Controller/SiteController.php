<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="produits")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/show", name="produit_show")
     */
    public function show()
    {

        return $this->render('show.html.twig');
    }

    /**
     * @Route("/form/new")
     */
    public function new(Request $request)
    {
        $article = new Article();
        $article->setTitle('Hello World');
        $article->setContent('Un très court article.');

        $form = $this->createForm(ArticleType::class, $article);

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/user/add" ,name="user_add")
     * @Route("/user/{id}/edit" ,name="user_edit")
     */
    public function userU(?User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$user) {
            $user = new User();
        }
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$user->getId()) {
                $entityManager->persist($user);
            }
            $entityManager->flush();
            return $this->redirect($this->generateUrl('user_edit', ['id' => $user->getId()]));
        }
        return $this->render('newU.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
