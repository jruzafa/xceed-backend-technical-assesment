<?php

declare(strict_types=1);

namespace Xceed\Tweet\Domain;

final readonly class TweetText
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('The text cannot be empty.');
        }

        $this->value = $value;
    }

    public static function create(string $value): TweetText
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}