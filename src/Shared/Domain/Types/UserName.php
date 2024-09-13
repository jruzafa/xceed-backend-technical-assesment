<?php

declare(strict_types=1);

namespace Xceed\Shared\Domain\Types;

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('The user name cannot be empty.');
        }

        $this->value = $value;
    }

    public static function create(string $userName): UserName
    {
        return new self($userName);
    }
}