<?php

namespace PE\Component\Flow;

final class Dataset
{
    /**
     * @var iterable
     */
    private $items;

    /**
     * @var array
     */
    private $options;

    /**
     * @param iterable $items
     * @param array    $options
     */
    public function __construct(iterable $items = [], array $options = [])
    {
        $this->items   = $items;
        $this->options = $options;
    }

    /**
     * @return iterable
     */
    public function getItems(): iterable
    {
        return $this->items;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasOption(string $name)
    {
        return array_key_exists($name, $this->options);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption(string $name, $default = null)
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : $default;
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return static
     */
    public function setOption(string $name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function delOption(string $name)
    {
        unset($this->options[$name]);
        return $this;
    }
}