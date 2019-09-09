<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignatureAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity2;

class SignatureAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    protected function setUp(): void
    {
        $this->class = SignatureAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getSignature()
        ));
    }

    public function testIsValidWithExampleEntity2(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity2::getSignature()
        ));
    }
}
