<?php

namespace PE\Flow\Definition;

trait DataTrait
{
    private array $data = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasDataItem(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getDataItem(string $key, $default = null)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public function setDataItem(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @param string $key
     * @return void
     */
    public function delDataItem(string $key): void
    {
        unset($this->data[$key]);
    }
}
