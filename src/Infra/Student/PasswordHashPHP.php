<?php

namespace Alura\Architecture\Infra\Student;

use Alura\Architecture\Domain\Student\PasswordHash;

class PasswordHashPHP implements PasswordHash
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
