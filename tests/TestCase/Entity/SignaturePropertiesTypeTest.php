<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\SignaturePropertyCollection;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;

class SignaturePropertiesTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignaturePropertiesType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SignaturePropertiesType::create()
            ->setIdAttribute($id = RandomString::get())
            ->setSignatureProperties(new SignaturePropertyCollection())
        ;
        $this->assertEquals($id, $entity->getIdAttribute());
        $this->assertInstanceOf(SignaturePropertyCollection::class, $entity->getSignatureProperties());

        $entity->addSignatureProperty(new SignaturePropertyType());
        $this->assertGreaterThan(0, $entity->getSignatureProperties()->count());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertTrue(true);
    }
}

