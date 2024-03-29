<?php

namespace App\Controller;

use App\DTO\TestRequestBodyDTO;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration',methods: ['POST'])]
    public function registration(Request $request, ManagerRegistry $managerRegistry,UserPasswordHasherInterface $passwordHasher, TestRequestBodyDTO $requestBodyDTO): Response
    {
        dd($requestBodyDTO);
        $user = new User();
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if($username != null && $password != null) {
            $em = $managerRegistry->getManager();
            $hasherPassword = $passwordHasher->hashPassword($user,$password);

            $user->setUsername($username);
            $user->setPassword($hasherPassword);
            $em->persist($user);
            $em->flush();

           return $this->json('',Response::HTTP_CREATED);
        }
        return $this->json('data', Response::HTTP_BAD_REQUEST);
    }
}
