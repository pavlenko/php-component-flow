<?php

namespace PE\Flow\Definition;

interface DataInterface
{
    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data): void;

    /**
     * @param string $key
     * @return bool
     */
    public function hasDataItem(string $key): bool;

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getDataItem(string $key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public function setDataItem(string $key, $value): void;

    /**
     * @param string $key
     * @return void
     */
    public function delDataItem(string $key): void;
}
