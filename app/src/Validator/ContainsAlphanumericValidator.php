<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Serializer\SerializerInterface;

class ContainsAlphanumericValidator extends ConstraintValidator
{
    public function __construct
    (
        private readonly SerializerInterface $serializer
    ){}
    public function validate(mixed $value, Constraint $constraint)
    {

    }
}