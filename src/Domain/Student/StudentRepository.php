<?php

namespace Alura\Architecture\Domain\Student;

use Alura\Architecture\Domain\CPF;

interface StudentRepository
{
    public function addOne(Student $student): void;

    public function findByCPF(CPF $cpf): Student;

    /** @return Student[] */
    public function findAll(): array;
}
