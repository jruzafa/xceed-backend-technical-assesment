<?php

declare(strict_types=1);

namespace Xceed\Tweet\Application;

readonly final class GetTweetsByUserNameRequest
{
    public function __construct(private string $userName, private int $limit)
    {}

    public function userName(): string
    {
        return $this->userName;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}