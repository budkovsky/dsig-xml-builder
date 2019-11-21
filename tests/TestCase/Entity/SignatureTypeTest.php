<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\ObjectTypeCollection;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class SignatureTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SignatureType::create()
            ->setSignedInfo(ExampleEntity::getSignedInfo())
            ->setSignatureValue(ExampleEntity::getSignatureValue())
            ->setKeyInfo(new KeyInfoType())
            ->setObjects(new ObjectTypeCollection())
            ->setIdAttribute($id = RandomString::get())
        ;
        $this->assertInstanceOf(SignedInfoType::class, $entity->getSignedInfo());
        $this->assertInstanceOf(SignatureValueType::class, $entity->getSignatureValue());
        $this->assertInstanceOf(KeyInfoType::class, $entity->getKeyInfo());
        $this->assertInstanceOf(ObjectTypeCollection::class, $entity->getObjects());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addObject(new ObjectType());
        $this->assertGreaterThan(0, $entity->getObjects()->count());

        $entity->setKeyInfo(new KeyInfoType());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new SignatureType();

        $this->assertNull($entity->getSignedInfo());
        $this->assertNull($entity->getSignatureValue());
        $this->assertNull($entity->getKeyInfo());
        $this->assertNull($entity->getObjects());
        $this->assertNull($entity->getIdAttribute());
    }
}
