<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Collection;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Entity\SignatureType;

class EntityCollectionTest extends TestCase
{
    use CreationTestTrait;

    protected function setUp(): void
    {
        $this->class = EntityCollection::class;
    }

    public function testEntityCanBeAddedToTheCollection(): void
    {
        $this->assertEquals(
            1,
            EntityCollection::create()->add(ExampleEntity::getCanonicalizationMethod())->count()
        );
    }

    public function testEntityCanBeReturnedByIndex(): void
    {
        $collection = EntityCollection::create()->add(new SignatureType());
        $this->assertInstanceOf(SignatureType::class, $collection->toArray()[0]);
    }

}
