<?php

namespace App\Security;


use App\Repository\TokenRepository;
use App\Repository\UserRepository;
use App\Service\AccessTokenService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;


class BearerAuthenticator extends AbstractAuthenticator
{
    private const AUTH_HEADER = 'Authorization';
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TokenRepository $tokenRepository,
        private readonly ManagerRegistry $managerRegistry,
        private readonly AccessTokenService $tokenService,
    ){}

    public function supports(Request $request): bool
    {
        return $request->headers->has(self::AUTH_HEADER);
    }

    public function authenticate(Request $request): Passport
    {
        $token = $request->headers->get(self::AUTH_HEADER);

        return new SelfValidatingPassport(
            new UserBadge($token, function (string $userIdentifier): ?UserInterface {
                $token = $this->tokenRepository->findOneBy(['accessToken' => $userIdentifier]);
                $date = new DateTime('now');
                if ($token->getAccessTokenExpiredAt() > $date) {
                    return $this->userRepository->findOneByAccessToken($userIdentifier);
                }
                else {
                    if ($token->getRefreshTokenExpiredAt() > $date) {
                        $accessToken = $this->tokenService->getAccessToken();

                        $token->setAccessToken($accessToken);

                        $this->managerRegistry->getManager()->persist($token);
                        $this->managerRegistry->getManager()->flush();

                        return $this->userRepository->findOneByAccessToken($userIdentifier);
                    }
                else {
                    return null;
                }
                }
            })
        );
    }

    public function onAuthenticationSuccess(Request $request,  $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }

}