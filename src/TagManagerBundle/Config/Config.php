<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Config;

readonly class Config
{
    public function __construct(
        private bool $isEnabled,
        private string $tagId,
        /**
         * @var array<array-key, string>
         */
        private array $cookieFlags,
        private Linker $linker,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function getTagId(): string
    {
        return $this->tagId;
    }

    /**
     * @return array<array-key, string>
     */
    public function getCookieFlags(): array
    {
        return $this->cookieFlags;
    }

    public function getLinker(): Linker
    {
        return $this->linker;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function toArray(): array
    {
        return [
            'is_enabled' => $this->isEnabled,
            'tag_id' => $this->tagId,
            'cookie_flags' => $this->cookieFlags,
            'linker' => $this->linker->toArray(),
        ];
    }
}
