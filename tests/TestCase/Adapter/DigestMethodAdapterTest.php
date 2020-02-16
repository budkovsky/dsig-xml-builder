<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\DigestMethodAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterTestTrait;
use PHPUnit\Framework\TestCase;

class DigestMethodAdapterTest extends TestCase
{
    use AdapterTestTrait;

    protected function setUp(): void
    {
        $this->class = DigestMethodAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getDigestMethod()
        ));
    }


}

