<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\DSAKeyValueAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterTestTrait;

class DSAKeyValueAdapterTest extends TestCase
{
    use AdapterTestTrait;

    protected function setUp(): void
    {
        $this->class = DSAKeyValueAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getDSAKeyValue()
        ));
    }

}

