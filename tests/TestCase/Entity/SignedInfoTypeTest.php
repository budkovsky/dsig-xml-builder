<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class SignedInfoTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignedInfoType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SignedInfoType::create()
            ->setCanonicalizationMethod(new CanonicalizationMethodType())
            ->setSignatureMethod(new SignatureMethodType())
            ->setReferences(new ReferenceTypeCollection())
            ->setIdAttribute($id = 'abdefgh')
        ;
        $this->assertInstanceOf(CanonicalizationMethodType::class, $entity->getCanonicalizationMethod());
        $this->assertInstanceOf(SignatureMethodType::class, $entity->getSignatureMethod());
        $this->assertInstanceOf(ReferenceTypeCollection::class, $entity->getReferences());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addReference(ExampleEntity::getReference());
        $this->assertGreaterThan(0, $entity->getReferences()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new SignedInfoType();

        $this->assertNull($entity->getCanonicalizationMethod());
        $this->assertNull($entity->getSignatureMethod());
        $this->assertNull($entity->getIdAttribute());
    }
}
