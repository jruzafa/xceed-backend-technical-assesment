<?php

namespace App\Tests\Unit\Xceed\Tweet\Application;

use App\Tests\Unit\Xceed\Tweet\Domain\TweetMother;
use App\Tests\Unit\Xceed\Tweet\Infrastructure\FakeTweetRepositoryInMemory;
use PHPUnit\Framework\TestCase;
use Xceed\Tweet\Application\GetTweetsByUserName;
use Xceed\Tweet\Application\GetTweetsByUserNameRequest;

class GetTweetsByUserNameTest extends TestCase
{
    private GetTweetsByUserName $useCase;
    private FakeTweetRepositoryInMemory $repository;

    protected function setUp(): void
    {
        $this->repository = new FakeTweetRepositoryInMemory();
        $this->useCase = new GetTweetsByUserName($this->repository);
    }

    public function testGetTweets(): void
    {
        $this->repository->store(TweetMother::create());
        $this->repository->store(TweetMother::create('This is another tweet'));

        $response = $this->useCase->execute(
            new GetTweetsByUserNameRequest('jhon.doe', 2)
        );

        self::assertCount(2, $response->tweets());
    }

    public function testGetTweetsInEmptyTimeLine(): void
    {
        $response = $this->useCase->execute(
            new GetTweetsByUserNameRequest('jhon.doe', 2)
        );

        self::assertEmpty($response->tweets());
    }
}
