<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config\Data;

use SpecterGlobal\Bundle\TagManagerBundle\Config\Linker;

final readonly class ConfigData
{
    /**
     * @return iterable<string, array{bool, string, array{string}, Linker}>
     */
    public static function dataMethodConstructor(): iterable
    {
        yield 'case 1' => [
            true,
            'G-220466675E31B9D1',
            [
                'Secure',
                'HttpOnly',
                'Partitioned',
            ],
            new Linker(true, true, 'query', ['example.org']),
        ];

        yield 'case 2' => [
            false,
            'G-220466675E31B9D2',
            [
                'Secure',
                'HttpOnly',
                'Partitioned',
            ],
            new Linker(false, false, 'fragment', ['example.org']),
        ];
    }

    /**
     * @return iterable<string, array{bool, string, array{string}, Linker}>
     */
    public static function dataMethodToArray(): iterable
    {
        yield 'case 1' => [
            true,
            'G-220466675E31B9D1',
            [
                'Secure',
                'HttpOnly',
                'Partitioned',
            ],
            new Linker(true, true, 'query', ['example.org']),
        ];

        yield 'case 2' => [
            false,
            'G-220466675E31B9D2',
            [
                'Secure',
                'HttpOnly',
                'Partitioned',
            ],
            new Linker(false, false, 'fragment', ['example.org']),
        ];
    }
}
