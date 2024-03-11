<?php

namespace App\Service;

class AccessTokenService
{
    public function getAccessToken(): string
    {
        $number = rand(1, 100000000000);

        return md5($number);
    }
}