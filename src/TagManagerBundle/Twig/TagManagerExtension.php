<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TagManagerExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'specter_global_tag_manager',
                [TagManagerRuntime::class, 'tagManager'],
                ['is_safe' => ['js', 'html']],
            ),
        ];
    }
}
