<?php

namespace app\extensions\flow;

trait OptionsTrait
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return static
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasOption(string $name): bool
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
     * @param mixed  $value
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
