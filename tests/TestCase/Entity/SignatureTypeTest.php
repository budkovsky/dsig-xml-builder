<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\KeyInfoTypeCollection;
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
            ->setKeyInfoCollection(new KeyInfoTypeCollection())
            ->setObjects(new ObjectTypeCollection())
            ->setIdAttribute($id = RandomString::get())
        ;
        $this->assertInstanceOf(SignedInfoType::class, $entity->getSignedInfo());
        $this->assertInstanceOf(SignatureValueType::class, $entity->getSignatureValue());
        $this->assertInstanceOf(KeyInfoTypeCollection::class, $entity->getKeyInfoCollection());
        $this->assertInstanceOf(ObjectTypeCollection::class, $entity->getObjects());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addObject(new ObjectType());
        $this->assertGreaterThan(0, $entity->getObjects()->count());

        $entity->addKeyInfo(new KeyInfoType());
        $this->assertGreaterThan(0, $entity->getKeyInfoCollection()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new SignatureType();

        $this->assertNull($entity->getSignedInfo());
        $this->assertNull($entity->getSignatureValue());
        $this->assertNull($entity->getKeyInfoCollection());
        $this->assertNull($entity->getObjects());
        $this->assertNull($entity->getIdAttribute());
    }
}
