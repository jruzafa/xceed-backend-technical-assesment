<?php

namespace App\Tests\Acceptance\App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class TweetConverterControllerTest extends WebTestCase
{
    public function testConvertTweetToHtml()
    {
        $client = static::createClient();

        /** @var Crawler $response */
        $client->request('GET', '/tweets/jackDorsey?limit=2');

        self::assertResponseIsSuccessful();
        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertJson($client->getResponse()->getContent());
        self::assertCount(2, json_decode($client->getResponse()->getContent(), true));
    }
}
