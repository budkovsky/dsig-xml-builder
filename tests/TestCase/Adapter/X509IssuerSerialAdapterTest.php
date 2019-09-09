<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\X509IssuerSerialAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use PHPUnit\Framework\TestCase;

class X509IssuerSerialAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    public function setUp(): void
    {
        $this->class = X509IssuerSerialAdapter::class;
        $this->schemaPath = __DIR__.'/../../../docs/partial-schema/x509_issuer_serial_element.xsd';
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getX509IssuerSerial()
        ));
    }



}

