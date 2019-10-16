<?php

namespace PE\Component\Flow\Definition;

interface PortInterface extends IdentityInterface, LabelledInterface, MetadataInterface, SettingsInterface
{
    public const TYPE_I = 'I';
    public const TYPE_O = 'O';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type): void;
}
