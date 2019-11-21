<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\TransformValidator;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

class TransformValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = TransformValidator::class;
    }

    public function testReportsNoErrorOnProperEntity(): void
    {
        $this->assertTrue(
            TransformValidator::create()->validate(
                TransformType::create()
                    ->setAlgorithmAttribute('http://www.myurl.com#somealgo')
            )
            ->isValid()
        );
    }

    public function testReportsInvalidIfAlgorithmAttributeNotSet(): void
    {
        $this->expectExceptionMessageRegExp('/Algorithm/');
        TransformValidator::create()->validate(TransformType::create());
    }

    public function testReportsInvalidIfAlgorithmIsNotValidUri(): void
    {
        $this->expectExceptionMessageRegExp('/Algorithm.+URI/');
        TransformValidator::create()->validate(
            TransformType::create()->setAlgorithmAttribute('123 2342 @#$@')
        );
    }
}
