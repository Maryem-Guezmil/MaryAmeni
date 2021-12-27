<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/new", name="ajoutArticle")
     */
    public function create()
    {

        return $this->render('create.html.twig');
    }

    /**
     * @Route("/show", name="produit_show")
     */
    public function show()
    {

        return $this->render('show.html.twig');
    }
}
