<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\X509IssuerSerialValidator;
use PHPUnit\Framework\TestCase;

class X509IssuerSerialValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = X509IssuerSerialValidator::class;
    }

    public function testReportsNoErrorOnProperEntity(): void
    {
        $entity = X509IssuerSerialType::create()
            ->setX509IssuerName(RandomString::get())
            ->setX509SerialNumber(rand(1,100000))
        ;

        $this->assertTrue(
            X509IssuerSerialValidator::create()->validate($entity)->isValid()
        );
    }

    public function testIsIssuerNameRequired(): void
    {
        $entity = X509IssuerSerialType::create()
            ->setX509SerialNumber(rand(1,100000))
        ;
        $this->expectExceptionMessageMatches('/IssuerName/');
        X509IssuerSerialValidator::create()->validate($entity);
    }

    public function testIsSerialNumberRequired(): void
    {
        $entity = X509IssuerSerialType::create()
            ->setX509IssuerName(RandomString::get())
        ;
        $this->expectExceptionMessageMatches('/SerialNumber/');
        X509IssuerSerialValidator::create()->validate($entity);
    }
}

