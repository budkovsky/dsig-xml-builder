<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\KeyName;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class KeyInfoTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = KeyInfoType::class;
    }

    public function testAreGettersNullable(): void
    {
        $entity = new KeyInfoType();

        $this->assertNull($entity->getIdAttribute());
        $this->assertNull($entity->getChildren());
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = KeyInfoType::create()
            ->setChildren( new EntityCollection())
            ->setIdAttribute($id = RandomString::get())
        ;
        $this->assertNotEmpty($entity->getIdAttribute());
        $this->assertIsString($entity->getIdAttribute());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addChild(new KeyName());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertGreaterThan(0, $entity->getChildren()->count());
    }

    public function testThrowsExceptionIfChildHasWrongType(): void
    {
        $this->expectException(\TypeError::class);
        KeyInfoType::create()->addChild(new \stdClass());
    }
}
