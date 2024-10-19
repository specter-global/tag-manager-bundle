<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Config\Data;

final readonly class LinkerData
{
    /**
     * @return iterable<string, array{bool, bool, string, array{string}}>
     */
    public static function dataMethodConstructor(): iterable
    {
        yield 'case 1' => [
            true,
            true,
            'query',
            ['example.org'],
        ];

        yield 'case 2' => [
            false,
            false,
            'fragment',
            ['example.org'],
        ];
    }

    /**
     * @return iterable<string, array{bool, bool, string, array{string}}>
     */
    public static function dataMethodToArray(): iterable
    {
        yield 'case 1' => [
            true,
            true,
            'query',
            ['example.org'],
        ];

        yield 'case 2' => [
            false,
            false,
            'fragment',
            ['example.org'],
        ];
    }
}
