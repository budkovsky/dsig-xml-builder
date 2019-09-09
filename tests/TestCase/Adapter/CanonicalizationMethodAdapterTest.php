<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\CanonicalizationMethodAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class CanonicalizationMethodAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    public function setUp(): void
    {
        $this->class = CanonicalizationMethodAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getCanonicalizationMethod()
        ));
    }
}

