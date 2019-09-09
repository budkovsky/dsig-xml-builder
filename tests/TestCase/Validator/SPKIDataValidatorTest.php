<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\SPKIDataValidator;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\SPKISexp;
use Budkovsky\Aid\Helper\RandomString;

class SPKIDataValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = SPKIDataValidator::class;
    }

    public function testReportsInvalidIfEmpty(): void
    {
        $this->expectExceptionMessageMatches('/SPKISexp/');
        SPKIDataValidator::create()->validate(new SPKIDataType());
    }

    public function testReportsInvalidIfSpkisexpChildExistsButEmpty(): void
    {
        $this->expectExceptionMessageMatches('/SPKISexp.+empty/');
        SPKIDataValidator::create()->validate(
            SPKIDataType::create()->addChild(
                SPKISexp::create()
            )
        );
    }

    public function testReportsInvalidIfSpkisexpChildIsNotBase64(): void
    {
        $this->expectExceptionMessageMatches('/SPKISexp.+base64/');
        SPKIDataValidator::create()->validate(
            SPKIDataType::create()->addChild(
                SPKISexp::create()->setSimpleContent('@$%#$%$ 1232 d356')
            )
        );
    }

    public function testCanValidateProperEntity(): void
    {
        $entity = SPKIDataType::create()->addChild(
            SPKISexp::create()->setSimpleContent(
                \base64_encode(RandomString::get(1000))
            )
        );
        $this->assertTrue(
            SPKIDataValidator::create()->validate($entity)->isValid()
        );

    }
}

