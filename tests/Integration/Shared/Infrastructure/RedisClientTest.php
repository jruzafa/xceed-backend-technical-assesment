<?php

namespace App\Tests\Integration\Shared\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Xceed\Shared\Infrastructure\Redis\RedisClient;

class RedisClientTest extends KernelTestCase
{
    private RedisClient $redisClient;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::$container;
        $this->redisClient = $container->get('Xceed\Shared\Infrastructure\Redis\RedisClient');
    }

    public function testSet(): void
    {
        $this->redisClient->set('test', 'test');

        $value = $this->redisClient->get('test');

        self::assertEquals('test', $value);
    }

    public function testGetInvalidKey(): void
    {
        $value = $this->redisClient->get('invalid_key');

        self::assertNull($value);
    }

    public function testSetObject()
    {
        $objectTest = new \stdClass();
        $objectTest->name = 'test';
        $key = 'test';

        $this->redisClient->set($key, $objectTest);

        $value = $this->redisClient->get('test');

        self::assertEquals($objectTest, $value);
    }
}
