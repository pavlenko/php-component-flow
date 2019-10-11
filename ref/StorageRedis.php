<?php

namespace app\extensions\flow;

final class StorageRedis implements StorageInterface
{
    /**
     * @var \Predis\Client|\Redis
     */
    private $client;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param \Predis\Client|\Redis $client
     * @param string                $prefix
     */
    public function __construct($client, string $prefix = '')
    {
        $this->client = $client;
        $this->prefix = $prefix;
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        $this->connect();
        return $this->client->exists("{$this->prefix}:{$key}");
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, $default = null)
    {
        $this->connect();
        return $this->client->get("{$this->prefix}:{$key}") ?: $default;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value): void
    {
        $this->connect();
        $this->client->set("{$this->prefix}:{$key}", $value);
    }

    /**
     * @inheritDoc
     */
    public function del(string $key): void
    {
        $this->connect();
        $this->client->del("{$this->prefix}:{$key}");
    }

    private function connect()
    {
        try {
            $this->client->ping();
        } catch (\Exception $ex) {
            $this->client->disconnect();
            $this->client->connect();
        }
    }
}
