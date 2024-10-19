<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use function dirname;
use function rtrim;

readonly class TemplateCompilerPass implements CompilerPassInterface
{
    public function __construct(
        private string $bundlePath,
        private string $bundleName,
    ) {
    }

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('twig.loader.native_filesystem')) {
            return;
        }

        $container
            ->getDefinition('twig.loader.native_filesystem')
            ->addMethodCall(
                'addPath',
                [
                    $this->getTemplatesPath(),
                    $this->getTemplatesNamespace(),
                ]
            )
        ;
    }

    private function getTemplatesPath(): string
    {
        return dirname($this->bundlePath) . '/templates';
    }

    private function getTemplatesNamespace(): string
    {
        return rtrim($this->bundleName, 'Bundle');
    }
}
