<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SignaturePropertyValidator;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\Aid\Collection\EntityCollection;

class SignaturePropertyValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SignaturePropertyValidator::class;
    }

    public function testReportsInvalidIfEmpty(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertyValidator::create()->validate(new SignaturePropertyType());
    }

    public function testReportsValidIfRequiredFieldsExist(): void
    {
        $this->assertTrue(
            SignaturePropertyValidator::create()
                ->validate(ExampleEntity::getSignatureProperty())
                ->isValid()
        );
    }

    public function testReportsInvalidIfTargetNotUri(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertyValidator::create()->validate(
            ExampleEntity::getSignatureProperty()->setTargetAttribute('#fdlog i34j05 30-409 g!@')
        );
    }

    public function testReportsInvalidIfAnyChildElementNotExists(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertyValidator::create()->validate(
            ExampleEntity::getSignatureProperty()->setChildren(new EntityCollection())
        );
    }

    public function testReportsInvalidIfTargetUriIsEmptyString(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertyValidator::create()->validate(
            ExampleEntity::getSignatureProperty()->setTargetAttribute('')
        );
    }

    public function testReportsInvalidIfIdAttributeExsistsButIsEmptyString(): void
    {
        $this->expectException(RestrictionException::class);
        SignaturePropertyValidator::create()->validate(
            ExampleEntity::getSignatureProperty()->setIdAttribute('')
       );
    }
}
