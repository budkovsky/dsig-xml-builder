<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterTestTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ReferenceAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class ReferenceAdapterTest extends TestCase
{
    use AdapterTestTrait;

    protected function setUp(): void
    {
        $this->class = ReferenceAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getReference()
        ));
    }
}
