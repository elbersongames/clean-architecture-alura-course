<?php

namespace Alura\Architecture\Tests\Domain\Student;

use Alura\Architecture\Domain\Student\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    public function testIfReturnsAnThrowWhenPassAnInvalidDDD(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The DDD number must be only two valid numbers.");

        new PhoneNumber("an invalid ddd", "123456789");
    }

    public function textIfReturnsAnThrowWhenPassAnInvalidNumber(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("The phone number must be only 8-9 valid numbers.");

        new PhoneNumber("31", "an invalid phone number");
    }

    public function testIfReturnsAnValidFormattedPhoneNumber(): void
    {
        $phone = new PhoneNumber("31", "912345678");
        self::assertEquals("(31) 912345678", $phone);
    }
}
