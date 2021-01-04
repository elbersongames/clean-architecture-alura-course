<?php

use Alura\Architecture\Domain\Student\Student;
use Alura\Architecture\Infra\Student\StudentRepositoryMemory;

require_once "vendor/autoload.php";

[, $cpf, $name, $email, $ddd, $phone] = $argv;

$student = Student::withCPFNameAndEmail($cpf, $name, $email)->addPhoneNumber($ddd, $phone);

$repository = new StudentRepositoryMemory();
$repository->addOne($student);
