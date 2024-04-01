<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;
#[Attribute]
class ContainsAlphanumeric extends Constraint
{
    public string $message = 'ожидает тип ';

    public function __construct(string $message = null, array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}