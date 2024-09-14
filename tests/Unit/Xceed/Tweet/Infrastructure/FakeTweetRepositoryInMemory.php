<?php

declare(strict_types=1);

namespace App\Tests\Unit\Xceed\Tweet\Infrastructure;

use Xceed\Shared\Domain\Types\Limit;
use Xceed\Shared\Domain\Types\UserName;
use Xceed\Tweet\Domain\Tweet;
use Xceed\Tweet\Domain\TweetCollection;
use Xceed\Tweet\Domain\TweetRepository;

final class FakeTweetRepositoryInMemory implements TweetRepository
{
    private TweetCollection $tweetCollection;

    public function __construct()
    {
        $this->tweetCollection = new TweetCollection();
    }

    public function searchByUserName(UserName $userName, Limit $limit): TweetCollection
    {
        return $this->tweetCollection;
    }

    public function store(Tweet $tweet): void
    {
        $this->tweetCollection->add($tweet);
    }
}