<?php

namespace App\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class TweetConverterControllerTest extends WebTestCase
{
    public function testConvertTweetToHtml()
    {
        $client = static::createClient();

        /** @var Crawler $response */
        $client->request('GET', '/tweets/jackDorsey?limit=2');

        $this->assertResponseIsSuccessful();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertCount(2, json_decode($client->getResponse()->getContent(), true));
    }

}