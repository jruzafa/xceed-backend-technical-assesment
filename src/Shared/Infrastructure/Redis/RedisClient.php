<?php

declare(strict_types=1);

namespace Xceed\Shared\Infrastructure\Redis;

use Redis;

final class RedisClient
{
    private const TIMEOUT_KEY = 300;
    private Redis $client;

    public function __construct(string $host, int $port) {
        $this->client = new Redis();
        $this->client->connect($host, $port);
    }

    public function get(string $key)
    {
        try {
            $result = $this->client->get($key);

            if (!$result) {
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
        $this->client->set($key, serialize($value), ['EX' => self::TIMEOUT_KEY]);
    }
}