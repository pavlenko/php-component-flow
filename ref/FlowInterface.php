<?php

namespace app\extensions\flow;

interface FlowInterface extends IdentityInterface, LabelledInterface
{
    /**
     * @return BlockInterface[]
     */
    public function getBlocks(): array;

    /**
     * @param BlockInterface[] $blocks
     *
     * @return static
     */
    public function setBlocks(array $blocks);

    /**
     * @param string $blockID
     *
     * @return BlockInterface|null
     */
    public function searchBlock(string $blockID): ?BlockInterface;

    /**
     * @param BlockInterface $block
     *
     * @return static
     */
    public function insertBlock(BlockInterface $block);

    /**
     * @param BlockInterface $block
     *
     * @return static
     */
    public function removeBlock(BlockInterface $block);

    /**
     * @return LinkInterface[]
     */
    public function getLinks(): array;

    /**
     * @param LinkInterface[] $links
     *
     * @return static
     */
    public function setLinks(array $links);

    /**
     * @param string $linkID
     *
     * @return LinkInterface|null
     */
    public function searchLink(string $linkID): ?LinkInterface;

    /**
     * @param LinkInterface $link
     *
     * @return static
     */
    public function insertLink(LinkInterface $link);

    /**
     * @param LinkInterface $link
     *
     * @return static
     */
    public function removeLink(LinkInterface $link);
}
