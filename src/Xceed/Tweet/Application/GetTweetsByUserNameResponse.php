<?php

declare(strict_types=1);

namespace Xceed\Tweet\Application;

readonly final class GetTweetsByUserNameResponse
{
    public function __construct(private array $tweets)
    {}

    public function tweets(): array
    {
        return $this->tweets;
    }
}