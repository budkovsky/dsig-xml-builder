<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\Aid\Helper\RandomString;

class SignatureMethodTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureMethodType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $algorithm = RandomString::get();
        $hmacOutputLength = \rand(0, 1000);
        $entity = SignatureMethodType::create()
            ->setAlgorithmAttribute($algorithm)
            ->setHmacOutputLength($hmacOutputLength)
        ;

        $this->assertEquals($algorithm, $entity->getAlgorithmAttribute());
        $this->assertEquals($hmacOutputLength, $entity->getHmacOutputLength());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(SignatureMethodType::create()->getAlgorithmAttribute());
        $this->assertNull(SignatureMethodType::create()->getHmacOutputLength());
    }
}
