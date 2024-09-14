<?php

declare(strict_types=1);

namespace Xceed\Shared\Domain\Types;

readonly final class Limit
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value > 10 || $value < 1) {
            throw new \InvalidArgumentException('The limit must be between 1 and 10.');
        }

        $this->value = $value;
    }

    public static function create(int $limit): Limit
    {
        return new self($limit);
    }

    public function value(): int
    {
        return $this->value;
    }
}