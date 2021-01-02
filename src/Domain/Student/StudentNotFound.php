<?php

namespace Alura\Architecture\Domain\Student;

class StudentNotFound extends \Exception
{
    public function __construct(string $cpf)
    {
        parent::__construct("The student with CPF '{$cpf}' was not found!");
    }
}
