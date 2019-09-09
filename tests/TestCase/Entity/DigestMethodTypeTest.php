<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use PHPUnit\Framework\TestCase;

class DigestMethodTypeTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            DigestMethodType::class,
            new DigestMethodType()
            );
    }

    public function testCanBeCreatedByStaticFactory(): void
    {
        $this->assertInstanceOf(
            DigestMethodType::class,
            DigestMethodType::create()
            );
    }

    public function testIsAlgorithmAttributeNullable(): void
    {
        $this->assertNull(DigestMethodType::create()->getAlgorithmAttribute());
    }

    public function testCanSetAlgorithmAttibute(): void
    {
        $algorithm = 'sha512';
        $digestMethod = new DigestMethodType();
        $digestMethod->setAlgorithmAttribute($algorithm);
        $this->assertEquals($algorithm, $digestMethod->getAlgorithmAttribute());
    }
}
