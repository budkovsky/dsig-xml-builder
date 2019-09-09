<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;



class RetrievalMethodTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = RetrievalMethodType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $uri = RandomString::get();
        $type = RandomString::get();
        $entity = RetrievalMethodType::create()
            ->setTransforms(new TransformTypeCollection())
            ->setUriAttribute($uri)
            ->setTypeAttribute($type)
        ;

        $this->assertInstanceOf(TransformTypeCollection::class, $entity->getTransforms());
        $this->assertEquals($uri, $entity->getUriAttribute());
        $this->assertEquals($type, $entity->getTypeAttribute());

        $entity->addTransform(new TransformType());
        $this->assertGreaterThan(0, $entity->getTransforms()->count());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(RetrievalMethodType::create()->getTypeAttribute());
    }
}

