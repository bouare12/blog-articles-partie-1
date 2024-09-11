<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articlesFindByUser = [];

        if ($this->getUser()) {

            $user = $this->getUser();

            if ($user instanceof User) {
                $username = $user->getUsername();

                $articlesFindByUser = $articleRepository->findArticlesByUsername($username);
            }
        }


        return $this->render('account/account.html.twig', [
            'articles' => $articlesFindByUser
        ]);
    }
}