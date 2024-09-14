<?php

namespace App\TweetBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xceed\Tweet\Application\GetTweetsByUserName;
use Xceed\Tweet\Application\GetTweetsByUserNameRequest;
use Xceed\Tweet\Infrastructure\TweetTextTransformer;

readonly final class TweetConverterController
{
    private GetTweetsByUserName $useCase;
    private TweetTextTransformer $transformer;

    public function __construct(GetTweetsByUserName $useCase, TweetTextTransformer $transformer)
    {
        $this->useCase = $useCase;
        $this->transformer = $transformer;
    }

    public function __invoke(Request $request, string $userName): JsonResponse
    {
        // todo: add validation from parameters
        $limit = $request->get('limit');

        try {
            $response = $this->useCase->execute(
                new GetTweetsByUserNameRequest($userName, (int) $limit)
            );

            return new JsonResponse($this->transformer->transform($response->tweets()));
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
