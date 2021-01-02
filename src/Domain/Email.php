<?php

namespace Alura\Architecture\Domain;

class Email
{
    private string $address;

    public function __construct(string $address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("You must fill with an valid email.");
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
