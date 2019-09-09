<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Adapter;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\AdapterSchemaValidatorTestTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignedInfoAdapter;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class SignedInfoAdapterTest extends TestCase
{
    use AdapterSchemaValidatorTestTrait;

    protected function setUp(): void
    {
        $this->class = SignedInfoAdapter::class;
    }

    public function testIsGeneratedXmlValidWithSchema(): void
    {
        $this->assertTrue($this->isGeneratedXmlValid(
            ExampleEntity::getSignedInfo()
        ));
    }
}
