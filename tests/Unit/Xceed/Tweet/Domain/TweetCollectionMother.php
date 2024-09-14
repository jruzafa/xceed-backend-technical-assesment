<?php

declare(strict_types=1);

namespace App\Tests\Unit\Xceed\Tweet\Domain;

use Xceed\Tweet\Domain\TweetCollection;

readonly final class TweetCollectionMother
{
    public static function createWithOneElement(): TweetCollection
    {
        $tweetCollection = new TweetCollection();

        $tweetCollection->add(TweetMother::create());

        return $tweetCollection;
    }
}