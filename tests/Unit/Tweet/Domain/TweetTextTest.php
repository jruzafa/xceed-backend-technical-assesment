<?php

namespace App\Tests\Unit\Tweet\Domain;

use PHPUnit\Framework\TestCase;
use Xceed\Tweet\Domain\TweetText;

class TweetTextTest extends TestCase
{
    public function testCreateTweetText(): void
    {
        $expectedTweetText = TweetText::create('This is a tweet text');
        $this->assertInstanceOf(TweetText::class, $expectedTweetText);
    }

    public function testCreateTweetTextWithEmptyText(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        TweetText::create('');
    }
}
