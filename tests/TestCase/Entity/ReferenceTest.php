<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

class ReferenceTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = ReferenceType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $digestValue = \base64_encode(RandomString::get(1000));
        $id = RandomString::get();
        $uri = RandomString::get();
        $type = RandomString::get();
        $entity = ReferenceType::create()
            ->setTransforms(new TransformTypeCollection())
            ->setDigestMethod(new DigestMethodType())
            ->setDigestValue($digestValue)
            ->setIdAttribute($id)
            ->setUriAttribute($uri)
            ->setTypeAttribute($type)
        ;

        $this->assertInstanceOf(TransformTypeCollection::class, $entity->getTransforms());
        $this->assertInstanceOf(DigestMethodType::class, $entity->getDigestMethod());
        $this->assertEquals($digestValue, $entity->getDigestValue());
        $this->assertEquals($id, $entity->getIdAttribute());
        $this->assertEquals($uri, $entity->getUriAttribute());
        $this->assertEquals($type, $entity->getTypeAttribute());

        $entity->addTransform(new TransformType());
        $this->assertGreaterThan(0, $entity->getTransforms()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new ReferenceType();
        $this->assertNull($entity->getDigestMethod());
        $this->assertNull($entity->getDigestValue());
        $this->assertNull($entity->getIdAttribute());
        $this->assertNull($entity->getTypeAttribute());
        $this->assertNull($entity->getUriAttribute());
    }

}

