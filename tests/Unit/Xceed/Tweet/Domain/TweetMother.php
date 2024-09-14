<?php

declare(strict_types=1);

namespace App\Tests\Unit\Xceed\Tweet\Domain;

use Xceed\Tweet\Domain\Tweet;
use Xceed\Tweet\Domain\TweetText;

readonly final class TweetMother
{
    public static function create(?string $tweetText = null): Tweet
    {
        $tweetText = TweetText::create($tweetText ?? 'This is a tweet');

        return new Tweet($tweetText);
    }
}