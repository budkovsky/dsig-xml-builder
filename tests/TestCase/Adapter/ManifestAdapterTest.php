<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterTestTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ManifestAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class ManifestAdapterTest extends TestCase
{
    use AdapterTestTrait;

    protected function setUp(): void
    {
        $this->class = ManifestAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getManifest()
        ));
    }
}
