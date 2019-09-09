<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Validator\Entity\DigestMethodValidator;
use PHPUnit\Framework\TestCase;

class DigestMethodValidatorTest extends TestCase
{
    public function testThrowsRestrictionExceptionWhenAlgorithmIsNull(): void
    {
        $digestMethod = new CanonicalizationMethodType();
        $this->expectException(RestrictionException::class);
        DigestMethodValidator::create()->validate($digestMethod);
    }

    public function testThrowsRestrictionExceptionWhenAlgorithmIsNotValidUri(): void
    {
        $digestMethod = new CanonicalizationMethodType();
        $digestMethod->setAlgorithmAttribute('$t530-9r xxc0- j0?(*&^%$#');
        $this->expectException(RestrictionException::class);
        DigestMethodValidator::create()->validate($digestMethod);
    }
}
