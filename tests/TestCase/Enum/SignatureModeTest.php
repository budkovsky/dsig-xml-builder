<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Enum;

use Budkovsky\DsigXmlBuilder\Enum\SignatureMode;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EnumTestTrait;
use PHPUnit\Framework\TestCase;

class SignatureModeTest extends TestCase
{
    use EnumTestTrait;

    protected function setUp(): void
    {
        $this->reflectionClass = new \ReflectionClass(SignatureMode::class);
    }
}
