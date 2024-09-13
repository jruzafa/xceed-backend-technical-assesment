<?php

declare(strict_types=1);

namespace Xceed\Tweet\Application;

final class GetTweetsByUserNameResponse
{
    private array $tweets;

    public function __construct(array $tweets)
    {
        $this->tweets = $tweets;
    }

    public function tweets(): array
    {
        return $this->tweets;
    }
}