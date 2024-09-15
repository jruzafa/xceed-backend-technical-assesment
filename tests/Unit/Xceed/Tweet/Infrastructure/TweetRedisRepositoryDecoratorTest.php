<?php

namespace App\Tests\Unit\Xceed\Tweet\Infrastructure;

use App\Tests\Unit\Xceed\Tweet\Domain\TweetMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Xceed\Shared\Domain\Types\Limit;
use Xceed\Shared\Domain\Types\UserName;
use Xceed\Shared\Infrastructure\Redis\RedisClient;
use Xceed\Tweet\Domain\TweetCollection;
use Xceed\Tweet\Infrastructure\TweetRedisRepositoryDecorator;

class TweetRedisRepositoryDecoratorTest extends TestCase
{
    private  MockObject $redisClient;
    private FakeTweetRepositoryInMemory $fakeTweetRepositoryInMemory;
    private TweetRedisRepositoryDecorator $repository;

    protected function setUp(): void
    {
        $this->redisClient = $this->createMock(RedisClient::class);
        $this->fakeTweetRepositoryInMemory = new FakeTweetRepositoryInMemory();
        $this->repository = new TweetRedisRepositoryDecorator($this->fakeTweetRepositoryInMemory, $this->redisClient);
    }

    public function testGetTweetsFromCacheRepository(): void
    {
        $tweet = TweetMother::create();
        $tweetCollection = new TweetCollection([$tweet]);

        $this->redisClient->expects($this->once())
            ->method('get')
            ->willReturn($tweetCollection);

        $result = $this->repository->searchByUserName(UserName::create('username'), Limit::create(10));

        self::assertEquals($tweetCollection, $result);
    }


    public function testGetTweetsFromInternalRepository(): void
    {
        $tweet = TweetMother::create();
        $tweetCollection = new TweetCollection([$tweet]);
        $this->fakeTweetRepositoryInMemory->store($tweet);

        $this->redisClient->expects($this->once())
            ->method('get')
            ->willReturn(null);

        $result = $this->repository->searchByUserName(UserName::create('username'), Limit::create(10));

        self::assertEquals($tweetCollection, $result);
    }
}
