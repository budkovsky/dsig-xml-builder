<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class ObjectTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = ObjectType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = ObjectType::create()
            ->setChildren(new EntityCollection())
            ->setMimeType($mimeType = 'application/xml')
            ->setEncoding($encoding = 'http://www.xxx.com#utf8')
            ->setIdAttribute($id = RandomString::get())
        ;
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertEquals($mimeType, $entity->getMimeType());
        $this->assertEquals($encoding, $entity->getEncoding());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addChild(new class implements EntityInterface{});
        $this->assertGreaterThan(0, $entity->getChildren()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new ObjectType();

        $this->assertNull($entity->getChildren());
        $this->assertNull($entity->getEncoding());
        $this->assertNull($entity->getIdAttribute());
        $this->assertNull($entity->getMimeType());
    }
}
