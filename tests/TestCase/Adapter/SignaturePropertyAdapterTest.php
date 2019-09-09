<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignaturePropertyAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleAnyAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use PHPUnit\Framework\TestCase;

class SignaturePropertyAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    protected function setUp(): void
    {
        $this->class = SignaturePropertyAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        SignaturePropertyAdapter::setAnyAdapter(ExampleAnyAdapter::create());

        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getSignatureProperty()
        ));
    }
}

