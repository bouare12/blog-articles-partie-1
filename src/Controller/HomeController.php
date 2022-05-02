<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        // dd($articles);

        return $this->render("home/index.html.twig", [
            'articles' => $articles
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->find($id);

        // dd($article);

        return $this->render("show/show.html.twig ", [
            'article' => $article
        ]);
    }

}
