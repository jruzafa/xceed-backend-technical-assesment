<?php

declare(strict_types=1);

namespace Xceed\Tweet\Infrastructure;

use Xceed\Shared\Domain\Types\Limit;
use Xceed\Shared\Domain\Types\UserName;
use Xceed\Shared\Infrastructure\Redis\RedisClient;
use Xceed\Tweet\Domain\TweetCollection;
use Xceed\Tweet\Domain\TweetRepository;

readonly final class TweetRedisRepositoryDecorator implements TweetRepository
{
    public function __construct(private TweetRepository $internalRepository, private RedisClient $redisClient) {}

    /**
     * @throws \RedisException
     */
    public function searchByUserName(UserName $userName, Limit $limit): TweetCollection
    {
        $tweets = $this->redisClient->get($userName->value());

        if (null === $tweets) {
            $tweets = $this->internalRepository->searchByUserName($userName, $limit);
            $this->redisClient->set($userName->value(), $tweets);
        }

        return $tweets;
    }
}