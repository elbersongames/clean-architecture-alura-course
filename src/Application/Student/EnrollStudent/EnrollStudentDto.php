<?php

namespace Alura\Architecture\Application\Student\EnrollStudent;

use Alura\Architecture\Domain\Student\Student;

class EnrollStudentDto
{
    private string $cpf;
    private string $name;
    private string $email;

    public function __construct(string $cpf, string $name, string $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
    }

    public function mount(): Student
    {
        return Student::withCPFNameAndEmail($this->cpf, $this->name, $this->email);
    }
}
