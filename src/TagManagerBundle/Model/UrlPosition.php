<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Model;

readonly class UrlPosition
{
    public const QUERY = 'query';
    public const FRAGMENT = 'fragment';

    public const CASES = [
        self::QUERY,
        self::FRAGMENT,
    ];
}
