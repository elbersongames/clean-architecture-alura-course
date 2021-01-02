<?php

namespace Alura\Architecture\Tests\Domain;

use Alura\Architecture\Domain\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    public function testIfReturnsAnThrowWhenPassAnInvalidCPFNumber(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new CPF("an invalid cpf");
    }

    public function testIfReturnsTheValidCPFNumber(): void
    {
        $cpf = new CPF("123.456.789-00");

        self::assertSame("123.456.789-00", (string) $cpf);
    }
}
