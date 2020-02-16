<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SPKIDataAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterTestTrait;
use PHPUnit\Framework\TestCase;

class SPKIDataAdapterTest extends TestCase
{
    use AdapterTestTrait;

    protected function setUp(): void
    {
        $this->class = SPKIDataAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue(
            $this->isGeneratedXmlValid(ExampleEntity::getSPKIData())
        );
    }
}
