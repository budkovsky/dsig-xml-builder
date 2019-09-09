<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignatureMethodAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class SignatureMethodAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    protected function setUp(): void
    {
        $this->class = SignatureMethodAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getSignatureMethod()
        ));
    }
}
