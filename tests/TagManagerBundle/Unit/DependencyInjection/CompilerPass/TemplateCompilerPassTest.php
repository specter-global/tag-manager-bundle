<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\DependencyInjection\CompilerPass;

use PHPUnit\Framework\TestCase;
use SpecterGlobal\Bundle\TagManagerBundle\DependencyInjection\CompilerPass\TemplateCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class TemplateCompilerPassTest extends TestCase
{
    public function testMethodProcessWhenTwigLoaderDefined(): void
    {
        $definitionMock = $this->createMock(Definition::class);
        $definitionMock
            ->expects($this->once())
            ->method('addMethodCall')
            ->with(
                'addPath',
                [
                    '/path/to/bundle/templates',
                    'TagManager',
                ]
            );

        $containerBuilderMock = $this->createMock(ContainerBuilder::class);
        $containerBuilderMock
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('twig.loader.native_filesystem')
            ->willReturn(true);

        $containerBuilderMock
            ->expects($this->once())
            ->method('getDefinition')
            ->with('twig.loader.native_filesystem')
            ->willReturn($definitionMock);

        $templateCompilerPass = new TemplateCompilerPass('/path/to/bundle/sources', 'TagManagerBundle');
        $templateCompilerPass->process($containerBuilderMock);
    }

    public function testMethodProcessWhenTwigLoaderNotDefined(): void
    {
        $definitionMock = $this->createMock(Definition::class);
        $definitionMock
            ->expects($this->never())
            ->method('addMethodCall')
            ->with(
                'addPath',
                [
                    '/path/to/bundle/templates',
                    'TagManager',
                ]
            );

        $containerBuilderMock = $this->createMock(ContainerBuilder::class);
        $containerBuilderMock
            ->expects($this->once())
            ->method('hasDefinition')
            ->with('twig.loader.native_filesystem')
            ->willReturn(false);

        $containerBuilderMock
            ->expects($this->never())
            ->method('getDefinition')
            ->with('twig.loader.native_filesystem')
            ->willReturn($definitionMock);

        $templateCompilerPass = new TemplateCompilerPass('/path/to/bundle/sources', 'TagManagerBundle');
        $templateCompilerPass->process($containerBuilderMock);
    }
}
