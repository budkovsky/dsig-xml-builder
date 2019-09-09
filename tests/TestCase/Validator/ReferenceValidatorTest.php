<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Validator\Entity\ReferenceValidator;
use PHPUnit\Framework\TestCase;

class ReferenceValidatorTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(ReferenceValidator::class, new ReferenceValidator());
    }

    public function testCanBeCreatedByStaticFactory(): void
    {
        $this->assertInstanceOf(ReferenceValidator::class, ReferenceValidator::create());
    }

    public function testValidatesRequiredFields(): void
    {
        $this->assertTrue(
            ReferenceValidator::create()
                ->validate(ExampleEntity::getReference())
                ->isValid()
        );

        $this->expectException(RestrictionException::class);
        ReferenceValidator::create()->validate(new ReferenceType());
    }

    public function testThrowsExceptionIfDigestValueIsNotBase64(): void
    {
        $entity = ExampleEntity::getReference()->setDigestValue('@$523 0wefg !!!%def gl');
        $this->expectException(RestrictionException::class);
        ReferenceValidator::create()->validate($entity);
    }

    public function testThrowsExceptionIfUriIsNotValidUri(): void
    {
        $entity = ExampleEntity::getReference()->setUriAttribute('123123 asdasd');
        $this->expectException(RestrictionException::class);
        ReferenceValidator::create()->validate($entity);
    }

    public function testThrowsExceptionIfTypeIsNotValidUri(): void
    {
        $entity = ExampleEntity::getReference()->setTypeAttribute('345345 zxczxc');
        $this->expectException(RestrictionException::class);
        ReferenceValidator::create()->validate($entity);
    }
}

