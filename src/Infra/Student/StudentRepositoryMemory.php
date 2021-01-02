<?php

namespace Alura\Architecture\Infra\Student;

use Alura\Architecture\Domain\CPF;
use Alura\Architecture\Domain\Student\DuplicatedStudents;
use Alura\Architecture\Domain\Student\Student;
use Alura\Architecture\Domain\Student\StudentNotFound;
use Alura\Architecture\Domain\Student\StudentRepository;

class StudentRepositoryMemory implements StudentRepository
{
    protected array $students = [];

    public function addOne(Student $student): void
    {
        $this->students[] = $student;
    }

    /**
     * @param CPF $cpf
     * @return Student
     * @throws DuplicatedStudents
     * @throws StudentNotFound
     */
    public function findByCPF(CPF $cpf): Student
    {
        $students = array_filter($this->students, static function (Student $student) use ($cpf) {
            return $student->cpf() === (string) $cpf;
        });

        if (count($students) === 0) {
            throw new StudentNotFound($cpf);
        }

        if (count($students) > 1) {
            throw new DuplicatedStudents($cpf);
        }

        return $students[0];
    }

    public function findAll(): array
    {
        return $this->students;
    }
}
