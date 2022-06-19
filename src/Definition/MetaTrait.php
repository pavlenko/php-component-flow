<?php

namespace PE\Flow\Definition;

trait MetaTrait
{
    private array $meta = [];

    /**
     * @return array
     */
    public function getMetaData(): array
    {
        return $this->meta;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasMetaItem(string $key): bool
    {
        return array_key_exists($key, $this->meta);
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getMetaItem(string $key, $default = null)
    {
        return array_key_exists($key, $this->meta) ? $this->meta[$key] : $default;
    }
}
