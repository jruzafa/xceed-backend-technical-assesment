<?php

namespace App\TweetBundle\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xceed\Tweet\Application\GetTweetsByUserName;
use Xceed\Tweet\Application\GetTweetsByUserNameRequest;
use Xceed\Tweet\Infrastructure\TweetTextTransformer;

readonly final class TweetConverterController
{
    public function __construct(
        private GetTweetsByUserName $useCase,
        private TweetTextTransformer $transformer,
        private LoggerInterface $logger
    )
    {}

    public function __invoke(Request $request, string $userName): JsonResponse
    {
        $limit = $request->get('limit', 0);

        try {
            $response = $this->useCase->execute(new GetTweetsByUserNameRequest($userName, (int) $limit));

            return new JsonResponse($this->transformer->transform($response->tweets()));
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return new JsonResponse(['error' => 'Internal server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
