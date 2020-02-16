<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use Budkovsky\DsigXmlBuilder\Enum\CanonicalizationAlgorithm;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use PHPUnit\Framework\TestCase;

class CanonicalizationAlgorithmTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(CanonicalizationAlgorithm::class);
    }
}
