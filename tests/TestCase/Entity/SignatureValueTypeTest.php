<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Entity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\EntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\Aid\Helper\RandomString;

class SignatureValueTypeTest extends TestCase
{
    use EntityTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureValueType::class;
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = SignatureValueType::create()
            ->setIdAttribute($id = RandomString::get())
            ->setSimpleContent($value = \base64_encode(RandomString::get(2^10)));

        $this->assertEquals($id, $entity->getIdAttribute());
        $this->assertEquals($value, $entity->getSimpleContent());
    }

    public function testAreGettersNullable(): void
    {
        $this->assertNull(SignatureValueType::create()->getIdAttribute());
        $this->assertNull(SignatureValueType::create()->getSimpleContent());
    }
}
