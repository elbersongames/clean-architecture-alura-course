<?php

namespace Alura\Architecture\Infra\Student;

use Alura\Architecture\Domain\CPF;
use Alura\Architecture\Domain\Student\Student;
use Alura\Architecture\Domain\Student\StudentNotFound;
use Alura\Architecture\Domain\Student\StudentRepository;
use PDO;

class StudentRepositoryPDO implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function addOne(Student $student): void
    {
        $sql = "INSERT INTO students VALUES (:cpf, :name, :email)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("cpf", $student->cpf());
        $stmt->bindValue("name", $student->name());
        $stmt->bindValue("email", $student->email());
        $stmt->execute();

        foreach ($student->phones() as $phone) {
            $sql = "INSERT INTO phones VALUES (:cpf_student, :ddd, :number);";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue("cpf_student", $student->cpf());
            $stmt->bindValue("ddd", $phone->ddd());
            $stmt->bindValue("number", $phone->number());
            $stmt->execute();
        }
    }

    /**
     * @param CPF $cpf
     * @return Student
     * @throws StudentNotFound
     */
    public function findByCPF(CPF $cpf): Student
    {
        $sql = "SELECT students.cpf, students.name, students.email, phones.ddd, phones.number as phone_number 
                FROM students
                LEFT JOIN phones ON phones.cpf_student = students.cpf
                WHERE cpf = :cpf;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue("cpf", $cpf);
        $stmt->execute();

        $studentData = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (count($studentData) === 0) {
            throw new StudentNotFound($cpf);
        }

        return $this->mapStudents($studentData);
    }

    public function findAll(): array
    {
        $sql = "SELECT students.cpf, students.name, students.email, phones.ddd, phones.number as phone_number 
                FROM students
                LEFT JOIN phones ON phones.cpf_student = students.cpf;";
        $stmt = $this->connection->query($sql);

        $studentList = $stmt->fetchAll(PDO::FETCH_OBJ);
        $students = [];

        foreach ($studentList as $studentData) {
            if (!array_key_exists($studentData->cpf, $students)) {
                $students[$studentData->cpf] = Student::withCPFNameAndEmail(
                    $studentData->cpf,
                    $studentData->name,
                    $studentData->email
                );
            }

            if (!is_null($studentData->ddd) && !is_null($studentData->phone_number)) {
                $students[$studentData->cpf]->addPhoneNumber($studentData->ddd, $studentData->phone_number);
            }
        }

        return array_values($students);
    }

    /**
     * @param array $studentData
     * @return Student
     */
    private function mapStudents(array $studentData): Student
    {
        $firstLine = $studentData[0];
        $student = Student::withCPFNameAndEmail($firstLine->cpf, $firstLine->name, $firstLine->email);
        $phones = array_filter($studentData, fn ($line) => $line->ddd !== null && $line->phone_number !== null);

        foreach ($phones as $phone) {
            $student->addPhoneNumber($phone->ddd, $phone->phone_number);
        }

        return $student;
    }
}
