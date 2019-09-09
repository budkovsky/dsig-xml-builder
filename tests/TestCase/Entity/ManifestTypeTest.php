<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\ManifestType;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;

class ManifestTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = ManifestType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $randomId = RandomString::get();
        $entity = ManifestType::create()
            ->setIdAttribute($randomId)
            ->setReferences(ReferenceTypeCollection::create()->add(
                ReferenceType::create()
            ))
        ;
        $this->assertEquals($randomId, $entity->getIdAttribute());
        $this->assertGreaterThan(0, $entity->getReferences()->count());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(ManifestType::create()->getIdAttribute());
    }

}
