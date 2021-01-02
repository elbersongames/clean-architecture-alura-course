<?php

namespace Alura\Architecture\Tests\Infra\Student;

use Alura\Architecture\Domain\CPF;
use Alura\Architecture\Domain\Student\Student;
use Alura\Architecture\Infra\Student\StudentRepositoryPDO;
use PHPUnit\Framework\TestCase;

class StudentRepositoryPDOTest extends TestCase
{
    private \PDO $pdo;
    private StudentRepositoryPDO $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pdo = new \PDO("sqlite::memory:");
        $content = file_get_contents(__DIR__."/../../../database.sql");
        $this->pdo->exec($content);
        $this->pdo->beginTransaction();

        $this->repository = new StudentRepositoryPDO($this->pdo);
    }

    public function testIfCanAddSomeStudentToDatabase(): void
    {
        $student = Student::withCPFNameAndEmail("123.456.789-00", "Tadeu Barbosa", "tadeu@email.com");
        $student->addPhoneNumber("31", "900000000");
        $this->repository->addOne($student);

        $response = $this->repository->findByCPF(new CPF("123.456.789-00"));
        self::assertSame("123.456.789-00", $response->cpf());
    }

    public function testIfCanGetManyStudents(): void
    {
        $student = Student::withCPFNameAndEmail("123.456.789-00", "Tadeu Barbosa", "tadeu@email.com");
        $this->repository->addOne($student);

        $student = Student::withCPFNameAndEmail("111.111.111-11", "Um", "1@email.com");
        $this->repository->addOne($student);

        $student = Student::withCPFNameAndEmail("222.222.222-22", "Dois", "2@email.com");
        $this->repository->addOne($student);

        $response = $this->repository->findAll();
        self::assertCount(3, $response);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->pdo->rollBack();
    }
}
