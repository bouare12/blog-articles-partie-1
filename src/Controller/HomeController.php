<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();

        // dd($articles);

        return $this->render("home/index.html.twig", [
            'articles' => $articles,
            'categories' => $categories
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

    #[Route('/showArticle/{id}', name: 'show_Article')]
    public function showArticle(?Category $categorie, CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        if($categorie) {

            $articles = $categorie->getArticles()->getValues();

        }else {

            return $this->redirectToRoute('app_home');
        }
        // $categorie = $categoryRepository->find($id);

        // dd($articles);

        return $this->render("home/index.html.twig", [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

}
