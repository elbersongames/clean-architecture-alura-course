<?php

namespace Alura\Architecture\Domain\Student;

class DuplicatedStudents extends \Exception
{
    public function __construct(string $cpf)
    {
        parent::__construct("WARNING: There's duplicates students with CPF: '$cpf'!");
    }
}
