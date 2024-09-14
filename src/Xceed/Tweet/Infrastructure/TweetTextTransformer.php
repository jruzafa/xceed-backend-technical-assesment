<?php

declare(strict_types=1);

namespace Xceed\Tweet\Infrastructure;

readonly final class TweetTextTransformer
{
    public function transform(array $tweets): array
    {
        return array_map(fn(string $tweet) => mb_strtoupper($tweet) , $tweets);
    }
}