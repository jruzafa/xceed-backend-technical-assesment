<?php

namespace App\Tests\Unit\Shared\Domain\Types;

use PHPUnit\Framework\TestCase;
use Xceed\Shared\Domain\Types\Limit;

class LimitTest extends TestCase
{
    public function testCreateLimit(): void
    {
        $expectedLimit = Limit::create(1);
        self::assertInstanceOf(Limit::class, $expectedLimit);
    }

    public function testCreateLimitWithGreatestMaxValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Limit::create(11);
    }

    public function testCreateLimitWithZeroValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Limit::create(0);
    }
}
