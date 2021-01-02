<?php

namespace Alura\Architecture\Domain\Student;

use Alura\Architecture\Domain\CPF;
use Alura\Architecture\Domain\Email;

class Student
{
    private CPF $cpf;
    private string $name;
    private Email $email;
    private array $phones;

    public static function withCPFNameAndEmail(string $cpf, string $name, string $email): self
    {
        return new Student(new CPF($cpf), $name, new Email($email));
    }

    public function __construct(CPF $cpf, string $name, Email $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
        $this->phones = [];
    }

    public function addPhoneNumber(string $ddd, string $number): self
    {
        $this->phones[] = new PhoneNumber($ddd, $number);

        return $this;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    /** @return PhoneNumber[] */
    public function phones(): array
    {
        return $this->phones;
    }
}
