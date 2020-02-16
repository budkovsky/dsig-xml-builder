<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use PHPUnit\Framework\TestCase;

class TagsTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(Tag::class);
    }
}
