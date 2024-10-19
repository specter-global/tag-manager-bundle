<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Config;

use SpecterGlobal\Bundle\TagManagerBundle\Model\UrlPosition;

readonly class Linker
{
    public function __construct(
        private bool $acceptIncoming,
        private bool $decorateForms,
        private string $urlPosition = UrlPosition::QUERY,
        /**
         * @var array<array-key, string>
         */
        private array $domains = [],
    ) {
    }

    public function isAcceptIncoming(): bool
    {
        return $this->acceptIncoming;
    }

    public function isDecorateForms(): bool
    {
        return $this->decorateForms;
    }

    public function getUrlPosition(): string
    {
        return $this->urlPosition;
    }

    /**
     * @return array<array-key, string>
     */
    public function getDomains(): array
    {
        return $this->domains;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function toArray(): array
    {
        return [
            'accept_incoming' => $this->acceptIncoming,
            'decorate_forms' => $this->decorateForms,
            'url_position' => $this->urlPosition,
            'domains' => $this->domains,
        ];
    }
}
