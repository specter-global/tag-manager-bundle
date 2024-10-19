<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Twig;

use SpecterGlobal\Bundle\TagManagerBundle\Config\Config;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\RuntimeExtensionInterface;

use function sprintf;
use function http_build_query;

class TagManagerRuntime implements RuntimeExtensionInterface
{
    private const TAG_MANAGER_URL = 'https://www.googletagmanager.com/gtag/js';

    public function __construct(
        private readonly Environment $environment,
        private readonly Config $config,
    ) {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function tagManager(): string
    {
        return $this->environment->render('@SpecterGlobalTagManager/tag_manager.html.twig', [
            'url' => $this->buildTagManagerUrl(),
            'config' => $this->config->toArray(),
        ]);
    }

    private function buildTagManagerUrl(): string
    {
        return sprintf(
            '%s?%s',
            self::TAG_MANAGER_URL,
            http_build_query([
                'id' => $this->config->getTagId(),
            ]),
        );
    }
}
