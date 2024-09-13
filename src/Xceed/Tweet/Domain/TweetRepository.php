<?php

namespace Xceed\Tweet\Domain;

use Xceed\Shared\Domain\Types\Limit;
use Xceed\Shared\Domain\Types\UserName;

interface TweetRepository
{
    public function searchByUserName(UserName $userName, Limit $limit): TweetCollection;
}
