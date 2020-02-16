<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class PGPDataTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = PGPDataType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = new PGPDataType();
        $randomPgpKeyId = \base64_encode(RandomString::get(100));
        $randomPgpKeyPacket = \base64_encode(RandomString::get(100));

        $entity->setChildren(new EntityCollection());
        $this->assertInstanceOf(
            EntityCollection::class,
            $entity->getChildren()
        );

        $entity->setPgpKeyId($randomPgpKeyId);
        $this->assertEquals($randomPgpKeyId, $entity->getPgpKeyId());

        $entity->setPgpKeyPacket($randomPgpKeyPacket);
        $this->assertEquals($randomPgpKeyPacket, $entity->getPgpKeyPacket());

        $entity->addChild(new KeyValueType());
        $this->assertGreaterThan(0, $entity->getChildren()->count());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new PGPDataType();
        $this->assertNull($entity->getChildren());
        $this->assertNull($entity->getPgpKeyId());
        $this->assertNull($entity->getPgpKeyPacket());
    }

}
