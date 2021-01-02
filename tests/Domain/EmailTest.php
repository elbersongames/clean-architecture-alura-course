<?php

namespace Alura\Architecture\Tests\Domain;

use Alura\Architecture\Domain\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testIfReturnAnThrowWhenCPFInInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email("an invalid email");
    }

    public function testGetsTheRightEmail(): void
    {
        $email = new Email("teste@email.com");
        self::assertSame("teste@email.com", (string) $email);
    }
}
