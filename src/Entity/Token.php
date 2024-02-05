<?php

namespace App\Entity;

use App\Repository\TokenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
class Token
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $accessToken = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $refreshToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $accessTokenExpiredAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $refreshTokenExpiredAt = null;

    #[ORM\ManyToOne(inversedBy: 'tokens')]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(string $accessToken): static
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(?string $refreshToken): static
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getAccessTokenExpiredAt(): ?\DateTimeInterface
    {
        return $this->accessTokenExpiredAt;
    }

    public function setAccessTokenExpiredAt(\DateTimeInterface $accessTokenExpiredAt): static
    {
        $this->accessTokenExpiredAt = $accessTokenExpiredAt;

        return $this;
    }

    public function getRefreshTokenExpiredAt(): ?\DateTimeInterface
    {
        return $this->refreshTokenExpiredAt;
    }

    public function setRefreshTokenExpiredAt(?\DateTimeInterface $refreshTokenExpiredAt): static
    {
        $this->refreshTokenExpiredAt = $refreshTokenExpiredAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->users;
    }

    public function setUser(?User $user): static
    {
        $this->users = $user;

        return $this;
    }
}
