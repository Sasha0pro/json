<?php

namespace App\Controller;

use App\Entity\Token;
use App\Repository\TokenRepository;
use App\Service\AccessTokenService;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

class SecurityController extends AbstractController
{
    public function __construct(
        readonly private UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    /**
     * @throws \Exception
     */
    #[Route('/', name: 'app_login')]
    public function login(Request $request, ManagerRegistry $managerRegistry, AccessTokenService $tokenService): Response
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if ($username != null && $password != null) {
            $user = $managerRegistry->getRepository(User::class)->findOneBy(['username' => $username]);

            if ($this->passwordHasher->isPasswordValid($user, $password)) {
                $accessToken = $tokenService->getAccessToken();

                $data = date('Y-m-d\\TH:i:sP', time()+ 30 * 60);
                $time = new DateTimeImmutable($data);

                $token = new Token();
                $token->setAccessToken($accessToken);
                $token->setUser($user);
                $token->setAccessTokenExpiredAt($time);

                $managerRegistry->getManager()->persist($token);
                $managerRegistry->getManager()->flush();

                return $this->redirectToRoute('app_main');
            }
        }

        return $this->render('security/login.html.twig');
    }

    /**
     * @throws \Exception
     */
    #[Route('/create/refreshToken', name: 'create_refreshToken')]
    public function createRefreshToken(Request $request, ManagerRegistry $managerRegistry, AccessTokenService $tokenService, TokenRepository $tokenRepository): Response
    {
        $accessToken = $request->headers->get('Authorization');

        $token = $tokenRepository->findOneBy(['accessToken' => $accessToken]);

        $data = date('Y-m-d\\TH:i:sP', time()+ 60 * 60 * 24);
        $time = new DateTimeImmutable($data);

        $refreshToken = $tokenService->getAccessToken();

        $token->setRefreshToken($refreshToken);
        $token->setRefreshTokenExpiredAt($time);

        $managerRegistry->getManager()->persist($token);
        $managerRegistry->getManager()->flush();

        return $this->redirectToRoute('app_main');
    }
}
