<?php

namespace Alura\Architecture\Domain\Student;

class PhoneNumber
{
    private string $ddd;
    private string $number;

    public function __construct(string $ddd, string $number)
    {
        $this->setDDD($ddd);
        $this->setNumber($number);
    }

    /**
     * @param string $ddd
     */
    private function setDDD(string $ddd): void
    {
        if (preg_match("/\d{2}/", $ddd) !== 1) {
            throw new \InvalidArgumentException("The DDD number must be only two valid numbers.");
        }

        $this->ddd = $ddd;
    }

    /**
     * @param string $number
     */
    private function setNumber(string $number): void
    {
        if (preg_match("/\d{8,9}/", $number) !== 1) {
            throw new \InvalidArgumentException("The phone number must be only 8-9 valid numbers.");
        }

        $this->number = $number;
    }

    public function __toString(): string
    {
        return "({$this->ddd}) {$this->number}";
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function number(): string
    {
        return $this->number;
    }
}
