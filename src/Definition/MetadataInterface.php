<?php

namespace PE\Component\Flow\Definition;

interface MetadataInterface
{
    /**
     * @return array
     */
    public function getMetadata(): array;

    /**
     * @param array $items
     */
    public function setMetadata(array $items): void;

    /**
     * @param string $name
     * @param null   $default
     *
     * @return mixed
     */
    public function getMetadataItem(string $name, $default = null);

    /**
     * @param string $name
     * @param        $value
     */
    public function setMetadataItem(string $name, $value): void;

    /**
     * @param string $name
     */
    public function delMetadataItem(string $name): void;
}