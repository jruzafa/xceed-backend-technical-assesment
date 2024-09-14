<?php

namespace App\Tests\Unit\Xceed\Tweet\Domain;

use PHPUnit\Framework\TestCase;
use Xceed\Tweet\Domain\Tweet;

class TweetTest extends TestCase
{
    public function testCreateTweet(): void
    {
        $tweet = TweetMother::create();

        self::assertInstanceOf(Tweet::class, $tweet);
    }
}
