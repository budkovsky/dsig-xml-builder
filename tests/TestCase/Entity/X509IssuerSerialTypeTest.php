<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\Aid\Helper\RandomString;

class X509IssuerSerialTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = X509IssuerSerialType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = X509IssuerSerialType::create()
            ->setX509IssuerName($issuerName = RandomString::get())
            ->setX509SerialNumber($issuerNumber = \rand(1, 100000))
        ;

        $this->assertEquals($issuerName, $entity->getX509IssuerName());
        $this->assertEquals($issuerNumber, $entity->getX509SerialNumber());
    }

    public function testAreGettersNullable(): void
    {
        $entity = new X509IssuerSerialType();

        $this->assertNull($entity->getX509IssuerName());
        $this->assertNull($entity->getX509SerialNumber());
    }

}

