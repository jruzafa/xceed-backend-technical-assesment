<?php

namespace App\Tests\Unit\Xceed\Tweet\Domain;

use PHPUnit\Framework\TestCase;
use Xceed\Tweet\Infrastructure\TweetTextTransformer;

class TweetTextTransformerTest extends TestCase
{
    private TweetTextTransformer $tweetTextTransformer;

    protected function setUp(): void
    {
        $this->tweetTextTransformer = new TweetTextTransformer();
    }

    public function testTransformFromLowerCaseToUpperCase(): void
    {
        $tweets = ['tweet1', 'tweet2'];
        $expected = ['TWEET1', 'TWEET2'];

        $this->assertEquals($expected, $this->tweetTextTransformer->transform($tweets));
    }
}
