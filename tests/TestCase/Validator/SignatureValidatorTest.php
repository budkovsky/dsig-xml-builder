<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignatureValidator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;

class SignatureValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureValidator::class;
    }

    public function testCanValidateSimpliestEntity(): void
    {
        $this->assertTrue(
            SignatureValidator::create()
                ->validate(ExampleEntity::getSignature())
                ->isValid()
        );
    }

    public function testReportsEmptySignedInfo(): void
    {
        $this->expectExceptionMessageMatches('/SignedInfo/');

        SignatureValidator::create()->validate(
            ExampleEntity::getSignature()
                ->setSignedInfo(new SignedInfoType())
        );
    }

    public function testReportsEmptySignatureValue(): void
    {
        $this->expectExceptionMessageMatches('/SignatureValue/');

        SignatureValidator::create()->validate(
            ExampleEntity::getSignature()
            ->setSignatureValue(new SignatureValueType())
        );
    }
}
