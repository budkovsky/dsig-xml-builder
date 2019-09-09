<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Collection\EntityCollection;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class X509DataTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = X509DataType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = X509DataType::create()
            ->addChild(new X509IssuerSerialType())
        ;
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertGreaterThan(0, $entity->getChildren()->count());

        $entity->setChildren(EntityCollection::create());
        $this->assertInstanceOf(EntityCollection::class, $entity->getChildren());
        $this->assertEquals(0, $entity->getChildren()->count());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(X509DataType::create()->getChildren());
    }
}
