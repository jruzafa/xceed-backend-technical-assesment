<?php

namespace Xceed\Tweet\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Xceed\Tweet\Infrastructure\TweetRepositoryInMemory;

final class TweetConverterController extends AbstractController
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
    public function index(TweetRepositoryInMemory $repo, Request $request, $userName)
    {
        return new JsonResponse([]);
    }
}
