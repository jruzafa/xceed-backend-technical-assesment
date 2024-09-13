<?php

namespace App\TweetBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Xceed\Tweet\Infrastructure\TweetRepositoryInMemory;

final class TweetConverterController
{
    /**
     * @Route("/tweets/{userName}", methods={"GET"})
     *
     * @param TweetRepositoryInMemory $repo
     * @param Request                 $request
     * @param                         $userName
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, $userName)
    {
        return new JsonResponse([]);
    }
}
