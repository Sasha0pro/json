<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;
/**
 *  @RequestBody
 **/
 class TestRequestBodyDTO implements DtoInterface
{
    #[Assert\Length(max: 2)]
    private string $username;
     #[Assert\Length(max: 2)]
    private string $password;
    public function getUsername(): string
    {
        return $this->username;
    }
     public function getPassword(): string
     {
         return $this->password;
     }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }



 }