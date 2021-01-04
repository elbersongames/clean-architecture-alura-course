<?php

namespace Alura\Architecture\Application\Indication;

use Alura\Architecture\Domain\Student\Student;

interface SendIndicationMail
{
    public function sendTo(Student $student);
}
