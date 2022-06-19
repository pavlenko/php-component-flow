<?php

namespace PE\Flow\Definition;

interface MetaInterface
{
    /**
     * @return array
     */
    public function getMetaData(): array;

    /**
     * @param string $key
     * @return bool
     */
    public function hasMetaItem(string $key): bool;

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getMetaItem(string $key, $default = null);
}
