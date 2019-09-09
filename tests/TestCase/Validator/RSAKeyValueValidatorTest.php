<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\RSAKeyValueValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;

class RSAKeyValueValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = RSAKeyValueValidator::class;
    }

    public function testIsModulusRequired(): void
    {
        $entity = RSAKeyValueType::create()->setExponent(\base64_encode(RandomString::get(100)));
        $this->expectException(RestrictionException::class);
        RSAKeyValueValidator::create()->validate($entity);
    }

    public function testIsExponentRequired(): void
    {
        $entity = RSAKeyValueType::create()->setModulus(\base64_encode(RandomString::get(100)));
        $this->expectException(RestrictionException::class);
        RSAKeyValueValidator::create()->validate($entity);
    }

    public function testValidatesIsModuluesBase64(): void
    {
        $entity = RSAKeyValueType::create()
            ->setExponent(\base64_encode(RandomString::get(100)))
            ->setModulus('123012938 wsfdepowioek')
        ;
        $this->expectException(RestrictionException::class);
        RSAKeyValueValidator::create()->validate($entity);
    }

    public function testValidatesIsExponentBase64(): void
    {
        $entity = RSAKeyValueType::create()
            ->setModulus(\base64_encode(RandomString::get(100)))
            ->setExponent('### @#wer defo')
        ;
        $this->expectException(RestrictionException::class);
        RSAKeyValueValidator::create()->validate($entity);
    }

    public function testCanValidateProperEntity(): void
    {
        $entity = RSAKeyValueType::create()
            ->setModulus(\base64_encode(RandomString::get(100)))
            ->setExponent(\base64_encode(RandomString::get(100)))
        ;
        $this->assertTrue(RSAKeyValueValidator::create()->validate($entity)->isValid());
    }
}

