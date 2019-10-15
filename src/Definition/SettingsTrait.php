<?php

namespace PE\Component\Flow\Definition;

/**
 * @codeCoverageIgnore
 */
trait SettingsTrait
{
    /**
     * @var array
     */
    private $settings = [];

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $items
     */
    public function setSettings(array $items): void
    {
        $this->settings = $items;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasSetting(string $name): bool
    {
        return array_key_exists($name, $this->settings);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getSetting(string $name, $default = null)
    {
        return $this->settings[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setSetting(string $name, $value): void
    {
        $this->settings[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function delSetting(string $name): void
    {
        unset($this->settings[$name]);
    }
}
