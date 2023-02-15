<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Mailer;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, Mailer $mailer): Response
    {
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setNombre($form->get('Nombre')->getData());
            $user->setApe1($form->get('Ape1')->getData());
            $user->setApe2($form->get('Ape2')->getData());
            $user->setNickname($form->get('Nickname')->getData());
            $user->setEmail($form->get('Email')->getData());
            $user->setNumTelegram($form->get('num_telegram')->getData());
            $user->setEmail($form->get('Email')->getData());
            $user->setRoles(array("ROLE_USER"));
            
            $mailer->sendWelcomeMessage($user);

            $entityManager->persist($user);
            $entityManager->flush();

            

            return $this->redirectToRoute('landing');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
