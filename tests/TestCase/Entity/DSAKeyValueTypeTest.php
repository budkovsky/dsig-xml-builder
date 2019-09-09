<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;

class DSAKeyValueTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = DSAKeyValueType::class;
    }

    public function testAreGettersNullable(): void
    {
        $entity = new DSAKeyValueType();
        $this->assertNull($entity->getG());
        $this->assertNull($entity->getJ());
        $this->assertNull($entity->getP());
        $this->assertNull($entity->getPgenCounter());
        $this->assertNull($entity->getQ());
        $this->assertNull($entity->getSeed());
        $this->assertNull($entity->getY());
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = new DSAKeyValueType();

        $g = RandomString::get();
        $entity->setG($g);
        $this->assertNotEmpty($entity->getG());
        $this->assertIsString($entity->getG());
        $this->assertEquals($g, $entity->getG());

        $j = RandomString::get();
        $entity->setJ($j);
        $this->assertNotEmpty($entity->getJ());
        $this->assertIsString($entity->getJ());
        $this->assertEquals($j, $entity->getJ());

        $p = RandomString::get();
        $entity->setP($p);
        $this->assertNotEmpty($entity->getP());
        $this->assertIsString($entity->getP());
        $this->assertEquals($p, $entity->getP());

        $pgenCounter = RandomString::get();
        $entity->setPgenCounter($pgenCounter);
        $this->assertNotEmpty($entity->getPgenCounter());
        $this->assertIsString($entity->getPgenCounter());
        $this->assertEquals($pgenCounter, $entity->getPgenCounter());

        $q = RandomString::get();
        $entity->setQ($q);
        $this->assertNotEmpty($entity->getQ());
        $this->assertIsString($entity->getQ());
        $this->assertEquals($q, $entity->getQ());

        $seed = RandomString::get();
        $entity->setSeed($seed);
        $this->assertNotEmpty($entity->getSeed());
        $this->assertIsString($entity->getSeed());
        $this->assertEquals($seed, $entity->getSeed());

        $y = RandomString::get();
        $entity->setY($y);
        $this->assertNotEmpty($entity->getY());
        $this->assertIsString($entity->getY());
        $this->assertEquals($y, $entity->getY());
    }
}
