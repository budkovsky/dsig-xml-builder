<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\Xpath;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class TransformTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = TransformType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = TransformType::create()
            ->setAlgorithmAttribute($algorithm = RandomString::get())
            ->addChild(new Xpath())
        ;
        $this->assertEquals($algorithm, $entity->getAlgorithmAttribute());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertGreaterThan(0, $entity->getChildren()->count());

        $entity->setChildren(new EntityCollection());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertEquals(0, $entity->getChildren()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new TransformType();

        $this->assertNull($entity->getAlgorithmAttribute());
        $this->assertNull($entity->getChildren());
    }
}
