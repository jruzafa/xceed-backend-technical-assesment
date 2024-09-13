<?php

declare(strict_types=1);

namespace Xceed\Tweet\Application;

final class GetTweetsByUserNameRequest
{
    private string $userName;
    private int $limit;

    public function __construct(string $userName, int $limit)
    {
        $this->userName = $userName;
        $this->limit = $limit;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}