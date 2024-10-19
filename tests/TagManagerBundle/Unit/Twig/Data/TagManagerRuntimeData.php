<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Twig\Data;

use SpecterGlobal\Bundle\TagManagerBundle\Config\Config;
use SpecterGlobal\Bundle\TagManagerBundle\Config\Linker;

final readonly class TagManagerRuntimeData
{
    /**
     * @return iterable<string, array{Config}>
     */
    public static function dataMethodTagManager(): iterable
    {
        yield 'case 1' => [
            new Config(
                true,
                'G-220466675E31B9D1',
                [
                    'Secure',
                    'HttpOnly',
                    'Partitioned',
                ],
                new Linker(true, true, 'query', ['example.org'])
            ),
        ];
    }
}
