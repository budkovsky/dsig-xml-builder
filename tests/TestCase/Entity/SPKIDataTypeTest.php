<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Collection\EntityCollection;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\SPKISexp;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class SPKIDataTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SPKIDataType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SPKIDataType::create()->addChild(new SPKISexp());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());

        $entity->setChildren(new EntityCollection());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(SPKIDataType::create()->getChildren());
    }

    public function testReportsInvalidIfWrongChild(): void
    {
        $this->expectException(\TypeError::class);
        SPKIDataType::create()->addChild(new \stdClass());
    }
}
