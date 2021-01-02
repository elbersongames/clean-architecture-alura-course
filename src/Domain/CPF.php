<?php

namespace Alura\Architecture\Domain;

class CPF
{
    private string $number;

    public function __construct(string $number)
    {
        $this->setNumber($number);
    }

    private function setNumber(string $number): void
    {
        $options = [
            "options" => [
                "regexp" => "/\d{3}.\d{3}.\d{3}\-\d{2}/"
            ]
        ];

        if (filter_var($number, FILTER_VALIDATE_REGEXP, $options) === false) {
            throw new \InvalidArgumentException(
                "You must pass an valid CPF number."
            );
        }

        $this->number = $number;
    }

    public function __toString(): string
    {
        return $this->number;
    }

}
