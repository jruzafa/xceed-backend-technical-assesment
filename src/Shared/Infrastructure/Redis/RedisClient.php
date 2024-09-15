<?php

declare(strict_types=1);

namespace Xceed\Shared\Infrastructure\Redis;

use Psr\Log\LoggerInterface;
use Redis;

class RedisClient
{
    private const TIMEOUT_KEY = 300;

    private Redis $client;
    private LoggerInterface $logger;

    public function __construct(string $host, int $port, LoggerInterface $logger) {
        $this->client = new Redis();
        $this->client->connect($host, $port);
        $this->logger = $logger;
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
            $this->logger->error($e->getMessage(), ['trace' => $e->getTraceAsString(), 'key' => $key]);

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