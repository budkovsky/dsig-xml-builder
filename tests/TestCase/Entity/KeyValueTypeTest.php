<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Helper\EntityTest;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use PHPUnit\Framework\TestCase;

class KeyValueTypeTest extends TestCase
{
    use EntityTestTrait {
        EntityTestTrait::testHasValidGetters as notUsed;
        EntityTestTrait::testHasValidSetters as notUsed2;
    }
    private const PROPERTIES_WITHOUT_GETTER_AND_SETTER = ['choice'];

    public function setUp(): void
    {
        $this->class = KeyValueType::class;
    }

    public function testHasValidGetters(): void
    {
        $this->assertTrue(
            EntityTest::hasValidGetters(
                new \ReflectionClass($this->class),
                self::PROPERTIES_WITHOUT_GETTER_AND_SETTER
            )
        );
    }

    public function testhasValidSetters(): void
    {
        $this->assertTrue(
            EntityTest::hasValidSetters(
                new \ReflectionClass($this->class),
                self::PROPERTIES_WITHOUT_GETTER_AND_SETTER
            )
        );
    }

    public function testAreGettersNullable(): void
    {
        $entity = new KeyValueType();
        $this->assertNull($entity->getDsaKeyValue());
        $this->assertNull($entity->getRsaKeyValue());
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = KeyValueType::create()
            ->setDsaKeyValue(new DSAKeyValueType())
            ->setRsaKeyValue(new RSAKeyValueType())
        ;

        $this->assertInstanceOf(DSAKeyValueType::class, $entity->getDsaKeyValue());
        $this->assertInstanceOf(RSAKeyValueType::class, $entity->getRsaKeyValue());
    }

}
