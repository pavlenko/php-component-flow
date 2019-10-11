<?php

namespace app\extensions\flow;

interface StatusesInterface
{
    /**
     * @return array
     */
    public function getStatuses(): array;

    /**
     * @param array $options
     *
     * @return static
     */
    public function setStatuses(array $options);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasStatus(string $name): bool;

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getStatus(string $name, $default = null);

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return static
     */
    public function setStatus(string $name, $value);

    /**
     * @param string $name
     *
     * @return static
     */
    public function delStatus(string $name);
}
