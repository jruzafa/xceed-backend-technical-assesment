<?php

declare(strict_types=1);

namespace Xceed\Tweet\Domain;

final class Tweet
{
    private TweetText $text;

    public function __construct(TweetText $text)
    {
        $this->text = $text;
    }

    public function text(): TweetText
    {
        return $this->text;
    }

    public function toArray(): string
    {
        return $this->text->value();
    }
}
