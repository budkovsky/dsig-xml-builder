<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Collection\EntityCollection;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class SignaturePropertyTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignaturePropertyType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SignaturePropertyType::create()
            ->setTargetAttribute($target = 'https://www.xyz.com#www')
            ->setIdAttribute($id = 'xyz')
            ->setChildren(new EntityCollection())
        ;
        $this->assertEquals($target, $entity->getTargetAttribute());
        $this->assertEquals($id, $entity->getIdAttribute());

        $entity->addChild(ExampleEntity::getAnyEntity());
        $this->assertGreaterThan(0, $entity->getChildren()->count());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(SignaturePropertyType::create()->getIdAttribute());
    }
}
