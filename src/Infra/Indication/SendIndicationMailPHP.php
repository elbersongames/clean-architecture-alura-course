<?php

namespace Alura\Architecture\Infra\Indication;

use Alura\Architecture\Application\Indication\SendIndicationMail;
use Alura\Architecture\Domain\Student\Student;

class SendIndicationMailPHP implements SendIndicationMail
{
    public function sendTo(Student $student): void
    {
        $to      = $student->email();
        $subject = "Test";
        $message = "Hello, {$student->name()}!";
        $headers = "From: tadefbarbosa@gmail.com";

        mail($to, $subject, $message, $headers);
    }
}
