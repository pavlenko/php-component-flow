<?php

namespace PE\Component\Flow\Definition;

interface SettingsInterface
{
    /**
     * @return array
     */
    public function getSettings(): array;

    /**
     * @param array $items
     */
    public function setSettings(array $items): void;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasSetting(string $name): bool;

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getSetting(string $name, $default = null);

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setSetting(string $name, $value): void;

    /**
     * @param string $name
     */
    public function delSetting(string $name): void;
}
