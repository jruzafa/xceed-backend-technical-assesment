<?php

namespace App\Tests\Unit\Xceed\Tweet\Domain;

use PHPUnit\Framework\TestCase;
use Xceed\Tweet\Domain\TweetCollection;

class TweetCollectionTest extends TestCase
{
    public function testAddTweetToCollection(): void
    {
        $tweetCollection = TweetCollectionMother::createWithOneElement();

        self::assertCount(1, $tweetCollection);
        self::assertFalse($tweetCollection->isEmpty());
    }

    public function testRemoveTweetFromCollection(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->add($tweet);
        $tweetCollection->remove($tweet);

        self::assertTrue($tweetCollection->isEmpty());
    }

    public function testClearCollection(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->add($tweet);
        $tweetCollection->clear();

        self::assertTrue($tweetCollection->isEmpty());
    }

    public function testContainsTweetInCollection(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->add($tweet);

        self::assertTrue($tweetCollection->contains($tweet));
    }

    public function testNotContainsTweetInCollection(): void
    {
        $tweetCollection = new TweetCollection();

        $tweet = TweetMother::create();

        self::assertFalse($tweetCollection->contains($tweet));
    }

    public function testIsEmptyCollection(): void
    {
        $tweetCollection = new TweetCollection();

        self::assertTrue($tweetCollection->isEmpty());
    }

    public function testGetIterator(): void
    {
        $tweetCollection = TweetCollectionMother::createWithOneElement();

        $iterator = $tweetCollection->getIterator();

        self::assertInstanceOf(\Traversable::class, $iterator);
    }

    public function testToArray(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->add($tweet);

        self::assertIsArray($tweetCollection->toArray());
    }
}
