<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, ManagerRegistry $managerRegistry, UserPasswordHasherInterface $hasherPass): Response
    {
        $Manager = $managerRegistry->getManager();
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        //analyse requête par le formufaire
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $hasherPass->hashPassword($user, $user->getPassword());
            
            $user->setPassword($hashedPassword);

            $Manager->persist($user);
            $Manager->flush();
            return $this->redirectToRoute('app_home');
            // dd($user);
        }

        return $this->render('security/index.html.twig', [
            'controller_name' => "Formualire d'inscription",
            'form' => $form->createView()
        ]);
    }
}
