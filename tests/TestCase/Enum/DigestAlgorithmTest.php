<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use PHPUnit\Framework\TestCase;

class DigestAlgorithmTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(DigestAlgorithm::class);
    }
}
