<?php

namespace App\Tests\Unit\Shared\Domain\Types;

use PHPUnit\Framework\TestCase;
use Xceed\Shared\Domain\Types\UserName;

class UserNameTest extends TestCase
{
    public function testCreateUserName(): void
    {
        $expectedUserName = UserName::create('JohnDoe');
        $this->assertInstanceOf(UserName::class, $expectedUserName);
    }

    public function testCreateUserNameWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        UserName::create('');
    }
}
