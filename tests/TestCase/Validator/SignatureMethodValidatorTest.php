<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignatureMethodValidator;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;

class SignatureMethodValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignatureMethodValidator::class;
    }

    public function testIsAlgorithmAttributeRequired(): void
    {
        $this->assertTrue(
            SignatureMethodValidator::create()
                ->validate(SignatureMethodType::create()->setAlgorithmAttribute('http://aaa.com/aaaa#sha1'))
                ->isValid()
        );

        $this->expectException(RestrictionException::class);
        SignatureMethodValidator::create()->validate(new SignatureMethodType());
    }

    public function testIsAlgorithmAttributeValidUri(): void
    {
        $this->expectException(RestrictionException::class);
        SignatureMethodValidator::create()->validate(
            SignatureMethodType::create()
                ->setAlgorithmAttribute('@#$@ 123 asd')
        );
    }
}
