<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\TransformAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class TransformAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    protected function setUp(): void
    {
        $this->class = TransformAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getTransform()
        ));
    }
}
