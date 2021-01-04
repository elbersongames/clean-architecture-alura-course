<?php

namespace Alura\Architecture\Infra\Student;

use Alura\Architecture\Domain\Student\PasswordHash;

class PasswordHashMd5 implements PasswordHash
{
    public function hash(string $password): string
    {
        return md5($password);
    }

    public function verify(string $password, string $hash): bool
    {
        return md5($password) === $hash;
    }
}
