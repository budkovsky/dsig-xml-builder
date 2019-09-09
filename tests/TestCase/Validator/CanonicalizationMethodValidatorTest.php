<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Validator\Entity\CanonicalizationMethodValidator;

class CanonicalizationMethodValidatorTest extends TestCase
{
    public function testThrowsRestrictionExceptionWhenAlgorithmIsNull(): void
    {
        $canonicalizationMethod = new CanonicalizationMethodType();
        $this->expectException(RestrictionException::class);
        CanonicalizationMethodValidator::create()->validate($canonicalizationMethod);
    }

    public function testThrowsRestrictionExceptionWhenAlgorithmIsNotValidUri(): void
    {
        $canonicalizationMethod = new CanonicalizationMethodType();
        $canonicalizationMethod->setAlgorithmAttribute('$t530-9r xxc0- j0?(*&^%$#');
        $this->expectException(RestrictionException::class);
        CanonicalizationMethodValidator::create()->validate($canonicalizationMethod);
    }
}
