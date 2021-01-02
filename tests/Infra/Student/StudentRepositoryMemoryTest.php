<?php

namespace Alura\Architecture\Infra\Student;

use Alura\Architecture\Domain\CPF;
use Alura\Architecture\Domain\Student\DuplicatedStudents;
use Alura\Architecture\Domain\Student\Student;
use Alura\Architecture\Domain\Student\StudentNotFound;
use PHPUnit\Framework\TestCase;

class StudentRepositoryMemoryTest extends TestCase
{
    private StudentRepositoryMemory $memoryRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->memoryRepo = new StudentRepositoryMemory();
    }

    public function testCanAddOne(): void
    {
        $student = Student::withCPFNameAndEmail("123.456.789-00", "Tadeu", "tadeu@email.com");
        $this->memoryRepo->addOne($student);

        $response = $this->memoryRepo->findByCPF(new CPF("123.456.789-00"));
        self::assertSame("123.456.789-00", $response->cpf());
    }

    public function testReturnThrowWithNoStudents(): void
    {
        $this->expectException(StudentNotFound::class);
        $this->memoryRepo->findByCPF(new CPF("123.456.789-00"));
    }

    public function testReturnThrowWithDuplicatedStudents(): void
    {
        $this->expectException(DuplicatedStudents::class);

        $student = Student::withCPFNameAndEmail("123.456.789-00", "Tadeu", "tadeu@email.com");
        $this->memoryRepo->addOne($student);

        $student = Student::withCPFNameAndEmail("123.456.789-00", "Felipe", "felipe@email.com");
        $this->memoryRepo->addOne($student);

        $this->memoryRepo->findByCPF(new CPF("123.456.789-00"));
    }

    public function testCanFindAll(): void
    {
        $student = Student::withCPFNameAndEmail("123.456.789-00", "Tadeu Barbosa", "tadeu@email.com");
        $this->memoryRepo->addOne($student);

        $student = Student::withCPFNameAndEmail("111.111.111-11", "Um", "1@email.com");
        $this->memoryRepo->addOne($student);

        $student = Student::withCPFNameAndEmail("222.222.222-22", "Dois", "2@email.com");
        $this->memoryRepo->addOne($student);

        $response = $this->memoryRepo->findAll();
        self::assertCount(3, $response);
    }
}
