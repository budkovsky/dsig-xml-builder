<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\Aid\Helper\RandomString;

class RSAKeyValueTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = RSAKeyValueType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $exponent = \base64_encode(RandomString::get(100));
        $modulus = \base64_encode(RandomString::get(100));
        $entity = RSAKeyValueType::create()
            ->setExponent($exponent)
            ->setModulus($modulus)
        ;

        $this->assertEquals($exponent, $entity->getExponent());
        $this->assertEquals($modulus, $entity->getModulus());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(RSAKeyValueType::create()->getExponent());
        $this->assertNull(RSAKeyValueType::create()->getModulus());
    }
}
