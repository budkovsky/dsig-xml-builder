<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignedInfoValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;

class SignedInfoValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignedInfoValidator::class;
    }


    public function testNoErrorsOnValidEntity(): void
    {
        $this->assertTrue(
            SignedInfoValidator::create()
                ->validate(ExampleEntity::getSignedInfo())
                ->isValid()
        );
    }

    public function testIsCanonicalizationMethodRequired(): void
    {
        $this->expectExceptionMessageRegExp('/CanonicalizationMethod/');

        SignedInfoValidator::create()->validate(
            ExampleEntity::getSignedInfo()
                ->setCanonicalizationMethod(new CanonicalizationMethodType())
        );
    }

    public function testIsSignatureMethodRequired(): void
    {
        $this->expectExceptionMessageRegExp('/SignatureMethod/');

        SignedInfoValidator::create()->validate(
            ExampleEntity::getSignedInfo()
                ->setSignatureMethod(new SignatureMethodType())
        );
    }

    public function testIsAtleastOneReferenceElementRequired(): void
    {
        $this->expectExceptionMessageRegExp('/Reference/');

        SignedInfoValidator::create()->validate(
            ExampleEntity::getSignedInfo()
                ->setReferences(new ReferenceTypeCollection())
        );
    }
}

