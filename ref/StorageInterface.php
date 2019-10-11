<?php

namespace app\extensions\flow;

interface StorageInterface
{
    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, $value): void;

    /**
     * @param string $key
     */
    public function del(string $key): void;
}
