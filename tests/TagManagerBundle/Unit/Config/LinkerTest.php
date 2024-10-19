<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use SpecterGlobal\Bundle\TagManagerBundle\Config\Linker;
use SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config\Data\LinkerData;

final class LinkerTest extends TestCase
{
    /**
     * @param array<array-key, string> $domains
     */
    #[DataProviderExternal(className: LinkerData::class, methodName: 'dataMethodConstructor')]
    public function testMethodConstructor(
        bool $acceptIncoming,
        bool $decorateForms,
        string $urlPosition,
        array $domains
    ): void {
        $linker = new Linker($acceptIncoming, $decorateForms, $urlPosition, $domains);

        $this->assertSame($acceptIncoming, $linker->isAcceptIncoming());
        $this->assertSame($decorateForms, $linker->isDecorateForms());
        $this->assertSame($urlPosition, $linker->getUrlPosition());
        $this->assertSame($domains, $linker->getDomains());
    }

    /**
     * @param array<array-key, string> $domains
     */
    #[DataProviderExternal(className: LinkerData::class, methodName: 'dataMethodToArray')]
    public function testMethodToArray(
        bool $acceptIncoming,
        bool $decorateForms,
        string $urlPosition,
        array $domains
    ): void {
        $linker = new Linker($acceptIncoming, $decorateForms, $urlPosition, $domains);

        $linkerAsArray = $linker->toArray();

        $this->assertIsArray($linkerAsArray);
        $this->assertArrayHasKey('accept_incoming', $linkerAsArray);
        $this->assertArrayHasKey('decorate_forms', $linkerAsArray);
        $this->assertArrayHasKey('url_position', $linkerAsArray);
        $this->assertArrayHasKey('domains', $linkerAsArray);

        $this->assertSame($acceptIncoming, $linkerAsArray['accept_incoming']);
        $this->assertSame($decorateForms, $linkerAsArray['decorate_forms']);
        $this->assertSame($urlPosition, $linkerAsArray['url_position']);
        $this->assertSame($domains, $linkerAsArray['domains']);
    }
}
