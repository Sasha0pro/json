<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @RequestBody
 **/
 class TestRequestBodyDTO implements DtoInterface
{
    private ?string $username = null;
    private ?string $password = null;

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