<?php

namespace Alura\Architecture\Application\Student\EnrollStudent;

use Alura\Architecture\Domain\Student\StudentRepository;

class EnrollStudent
{
    /**
     * @var StudentRepository
     */
    private StudentRepository $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(EnrollStudentDto $studentDto): void
    {
        $student = $studentDto->mount();
        $this->repository->addOne($student);
    }
}
