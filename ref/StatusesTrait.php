<?php

namespace app\extensions\flow;

trait StatusesTrait
{
    /**
     * @var array
     */
    private $statuses = [];

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    /**
     * @param array $statuses
     *
     * @return static
     */
    public function setStatuses(array $statuses)
    {
        $this->statuses = $statuses;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasStatus(string $name): bool
    {
        return array_key_exists($name, $this->statuses);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getStatus(string $name, $default = null)
    {
        return array_key_exists($name, $this->statuses) ? $this->statuses[$name] : $default;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return static
     */
    public function setStatus(string $name, $value)
    {
        $this->statuses[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function delStatus(string $name)
    {
        unset($this->statuses[$name]);
        return $this;
    }
}
