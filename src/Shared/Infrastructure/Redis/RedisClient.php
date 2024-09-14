<?php

declare(strict_types=1);

namespace Xceed\Shared\Infrastructure\Redis;

use Predis\ClientInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

final class RedisClient
{
    private ClientInterface $client;

    public function __construct(string $dsn) {
        $this->client = RedisAdapter::createConnection($dsn);
    }

    public function get(string $key)
    {
        try {
            $result = $this->client->get($key);

            if (null === $result) {
                return null;
            }

            return unserialize($result);
        } catch (\RedisException $e) {
            return null;
        }
    }

    /**
     * @throws \RedisException
     */
    public function set(string $key, $value): void
    {
        $this->client->set($key, serialize($value));
    }
}