<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Abstraction;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Exception\SignatureModeException;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopedSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Enum\SignatureMode;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Facade\RSADetachedSignatureGenerator;

class RSAGeneratorAbstractTest extends TestCase
{
    public function testFactoryThrowsExceptionOnInvalidModeParameters(): void
    {
        $this->expectException(SignatureModeException::class);
        RSAGeneratorAbstract::factory('aaaa');
    }

    public function testFactoryCanCreateEnvelopedSignatureGenerator(): void
    {
        $this->assertInstanceOf(
            RSAEnvelopedSignatureGenerator::class,
            RSAGeneratorAbstract::factory(
                SignatureMode::ENVELOPED
            )
        );
    }

    public function testFactoryCanCreateEnvelopingSignatureGenerator(): void
    {
        $this->assertInstanceOf(
            RSAEnvelopingSignatureGenerator::class,
            RSAGeneratorAbstract::factory(
                SignatureMode::ENVELOPING
            )
        );
    }

    public function testFactoryCanCreateDetachedSignatureGenerator(): void
    {
        $this->assertInstanceOf(
            RSADetachedSignatureGenerator::class,
             RSAGeneratorAbstract::factory(
                SignatureMode::DETACHED
            )
        );
    }
}
