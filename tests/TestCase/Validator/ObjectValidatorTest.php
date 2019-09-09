<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\ObjectValidator;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\Aid\Helper\RandomString;

class ObjectValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = ObjectValidator::class;
    }

    public function testIsIdAttributeNotEmptyIfExists(): void
    {
        $this->expectExceptionMessageMatches('/Id.+empty/');
        ObjectValidator::create()->validate(
            ObjectType::create()
                ->setIdAttribute('')
        );
    }

    public function testIsMimetypeAttributeNotEmptyIfExists(): void
    {
        $this->expectExceptionMessageMatches('/MimeType.+empty/');
        ObjectValidator::create()->validate(
            ObjectType::create()
                ->setMimeType('')
        );
    }

    public function testIsMEncodingAttributeNotEmptyIfExists(): void
    {
        $this->expectExceptionMessageMatches('/Encoding.+URI/');
        ObjectValidator::create()->validate(
            ObjectType::create()
            ->setEncoding('')
        );
    }

    public function testReportsNoErrorWithProperAttributes(): void
    {
        $entity = ObjectType::create()
            ->setIdAttribute(RandomString::get())
            ->setMimeType('application/xml')
            ->setEncoding('http://www.abcef.com/aaa@xyz')
        ;
        $this->assertTrue(ObjectValidator::create()->validate($entity)->isValid());
    }
}
