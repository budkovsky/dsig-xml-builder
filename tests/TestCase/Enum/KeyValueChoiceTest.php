<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use Budkovsky\DsigXmlBuilder\Enum\KeyValueChoice;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use PHPUnit\Framework\TestCase;

class KeyValueChoiceTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(KeyValueChoice::class);
    }
}
