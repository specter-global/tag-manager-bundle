<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use SpecterGlobal\Bundle\TagManagerBundle\Config\Config;
use SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Twig\Data\TagManagerRuntimeData;
use SpecterGlobal\Bundle\TagManagerBundle\Twig\TagManagerRuntime;
use Twig\Environment;

final class TagManagerRuntimeTest extends TestCase
{
    #[DataProviderExternal(className: TagManagerRuntimeData::class, methodName: 'dataMethodTagManager')]
    public function testMethodTagManager(Config $config): void
    {
        $environment = $this->createMock(Environment::class);

        $tagManagerRuntime = new TagManagerRuntime(
            $environment,
            $config,
        );

        $environment
            ->expects($this->once())
            ->method('render')
            ->with('@SpecterGlobalTagManager/tag_manager.html.twig', [
                'url' => 'https://www.googletagmanager.com/gtag/js?id=' . $config->getTagId(),
                'config' => $config->toArray(),
            ]);

        $tagManagerRuntime->tagManager();
    }
}
