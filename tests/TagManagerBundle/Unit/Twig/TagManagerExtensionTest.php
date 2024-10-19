<?php

declare(strict_types=1);

namespace SpecterGlobal\Bundle\TagManagerBundle\Tests\Unit\Twig;

use PHPUnit\Framework\TestCase;
use SpecterGlobal\Bundle\TagManagerBundle\Twig\TagManagerExtension;
use Twig\TwigFunction;

final class TagManagerExtensionTest extends TestCase
{
    public function testMethodGetFunctionsReturnsArrayOfTwigFunctions(): void
    {
        $tagManagerExtension = new TagManagerExtension();
        $tagManagerExtensionFunctions = $tagManagerExtension->getFunctions();

        $this->assertIsArray($tagManagerExtensionFunctions);

        foreach ($tagManagerExtensionFunctions as $tagManagerExtensionFunction) {
            $this->assertInstanceOf(TwigFunction::class, $tagManagerExtensionFunction);
        }
    }
}
