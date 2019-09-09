<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;

class CanonicalizationMethodTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = CanonicalizationMethodType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $canonicalizationMethod = CanonicalizationMethodType::create()->setAlgorithmAttribute($algorithm = 'sha512');
        $this->assertEquals($algorithm, $canonicalizationMethod->getAlgorithmAttribute());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(CanonicalizationMethodType::create()->getAlgorithmAttribute());
    }

}
