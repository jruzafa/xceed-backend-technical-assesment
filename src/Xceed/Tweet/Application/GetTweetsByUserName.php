<?php

declare(strict_types=1);

namespace Xceed\Tweet\Application;

use Xceed\Shared\Domain\Types\Limit;
use Xceed\Shared\Domain\Types\UserName;
use Xceed\Tweet\Domain\TweetRepository;

readonly final class GetTweetsByUserName
{
    public function __construct(private TweetRepository $tweetRepository)
    {}

    public function execute(GetTweetsByUserNameRequest $request): GetTweetsByUserNameResponse
    {
        $tweetCollection = $this->tweetRepository->searchByUserName(
            UserName::create($request->userName()),
            Limit::create($request->limit())
        );

        return new GetTweetsByUserNameResponse($tweetCollection->toArray());
    }
}