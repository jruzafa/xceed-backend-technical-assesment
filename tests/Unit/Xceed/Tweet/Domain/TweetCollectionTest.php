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

    public function testOffsetGet(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->add($tweet);

        self::assertEquals($tweet, $tweetCollection->offsetGet($tweet));
    }

    public function testOffsetSet(): void
    {
        $tweetCollection = new TweetCollection();
        $tweet = TweetMother::create();

        $tweetCollection->offsetSet($tweet, $tweet);

        self::assertEquals($tweet, $tweetCollection->offsetGet($tweet));
    }

    public function testUnset(): void
    {
        $tweetCollection = TweetCollectionMother::createWithOneElement();
        $tweet = TweetMother::create();

        $tweetCollection->offsetUnset($tweet);

        self::assertFalse($tweetCollection->offsetExists($tweet));
    }

    public function testCreateWithInvalidTypeElement()
    {
        $this->expectException(\InvalidArgumentException::class);
        
        new TweetCollection([new \stdClass()]);
    }
}
