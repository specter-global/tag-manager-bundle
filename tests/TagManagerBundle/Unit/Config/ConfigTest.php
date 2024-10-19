<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use SpecterGlobal\Bundle\TagManagerBundle\Config\Config;
use SpecterGlobal\Bundle\TagManagerBundle\Config\Linker;
use SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config\Data\ConfigData;

final class ConfigTest extends TestCase
{
    /**
     * @param array{array-key, string} $cookieFlags
     */
    #[DataProviderExternal(className: ConfigData::class, methodName: 'dataMethodConstructor')]
    public function testMethodConstructor(bool $isEnabled, string $tagId, array $cookieFlags, Linker $linker): void
    {
        $config = new Config($isEnabled, $tagId, $cookieFlags, $linker);

        $this->assertSame($isEnabled, $config->isEnabled());
        $this->assertSame($tagId, $config->getTagId());
        $this->assertSame($cookieFlags, $config->getCookieFlags());
        $this->assertSame($linker, $config->getLinker());
    }

    /**
     * @param array{array-key, string} $cookieFlags
     */
    #[DataProviderExternal(className: ConfigData::class, methodName: 'dataMethodToArray')]
    public function testMethodToArray(bool $isEnabled, string $tagId, array $cookieFlags, Linker $linker): void
    {
        $config = new Config($isEnabled, $tagId, $cookieFlags, $linker);

        $configAsArray = $config->toArray();

        $this->assertIsArray($configAsArray);

        $this->assertArrayHasKey('is_enabled', $configAsArray);
        $this->assertArrayHasKey('tag_id', $configAsArray);
        $this->assertArrayHasKey('cookie_flags', $configAsArray);
        $this->assertArrayHasKey('linker', $configAsArray);

        $this->assertIsArray($configAsArray['linker']);
        $this->assertArrayHasKey('accept_incoming', $configAsArray['linker']);
        $this->assertArrayHasKey('decorate_forms', $configAsArray['linker']);
        $this->assertArrayHasKey('url_position', $configAsArray['linker']);
        $this->assertArrayHasKey('domains', $configAsArray['linker']);

        $this->assertSame($config->isEnabled(), $configAsArray['is_enabled']);
        $this->assertSame($config->getTagId(), $configAsArray['tag_id']);
        $this->assertSame($config->getCookieFlags(), $configAsArray['cookie_flags']);
        $this->assertSame($config->getLinker()->toArray(), $configAsArray['linker']);
    }
}
