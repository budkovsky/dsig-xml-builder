<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignaturePropertiesValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class SignaturePropertiesValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignaturePropertiesValidator::class;
    }

    public function testIsSignaturePropertyRequired(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertiesValidator::create()->validate(new SignaturePropertiesType());
    }

    public function testIsIdAttributeNotEmptyStringIfSet(): void
    {
        $entity = ExampleEntity::getSignatureProperties()
            ->setIdAttribute('asdasdasd');

        $this->assertTrue(
            SignaturePropertiesValidator::create()
                ->validate($entity)
                ->isValid()
        );

        $this->expectException(RestrictionException::class);
        SignaturePropertiesValidator::create()->validate($entity->setIdAttribute(''));
    }
}

