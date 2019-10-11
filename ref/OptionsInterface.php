<?php

namespace app\extensions\flow;

interface OptionsInterface
{
    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @param array $options
     *
     * @return static
     */
    public function setOptions(array $options);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasOption(string $name): bool;

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption(string $name, $default = null);

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return static
     */
    public function setOption(string $name, $value);

    /**
     * @param string $name
     *
     * @return static
     */
    public function delOption(string $name);
}
