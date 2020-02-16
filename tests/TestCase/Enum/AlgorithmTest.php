<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use Budkovsky\DsigXmlBuilder\Enum\Algorithm;

class AlgorithmTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(Algorithm::class);
    }
}
