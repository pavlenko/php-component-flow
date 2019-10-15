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
}