<?php

namespace Xceed\Tweet\Infrastructure;

interface TweetRepository
{
    public function searchByUserName(string $username, int $limit): array;
}
