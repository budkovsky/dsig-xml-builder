<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignatureValueValidator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;

class SignatureValueValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureValueValidator::class;
    }

    public function testCanValidateIsValueBase64String(): void
    {
        $this->expectExceptionMessageRegExp('/simpleContent/');
        SignatureValueValidator::create()
            ->validate(
                ExampleEntity::getSignatureValue()
                    ->setSimpleContent('#$%^&*')
            )
        ;
    }
}

