<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Facade;

use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\DsigXmlBuilder\Facade\RSADetachedSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleKey;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Tests\Partial\RSASignatureVerifyTrait;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\OpenSslWrapper\PrivateKey;
use PHPUnit\Framework\TestCase;

class DetachedRSASignatureGeneratorTest extends TestCase
{
    use CreationTestTrait;
    use RSASignatureVerifyTrait;

    protected function setUp(): void
    {
        $this->class = RSADetachedSignatureGenerator::class;
    }

    public function testCanGenratedDetachedXmlSignature(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSADetachedSignatureGenerator::create()
            ->setContent('http://www.di-mgt.com.au/abc.html')
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()
                    ->setPrivateKey(PrivateKey::create())
            )
        ;

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testCanGenerateDetachedXmlSignatureWithCertificateChain(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSADetachedSignatureGenerator::create()
            ->setKeystore($keystore = ExampleKey::getKeystore())
            ->setContent('http://www.di-mgt.com.au/abc.html')
            ->setKeyInfoMode(KeyInfoMode::RSA_X509DATA_CERTIFICATE | KeyInfoMode::RSA_X509DATA_EXTRA_CERTS)
        ;

        $this->assertTrue(
            $this->isSignatureWithTrustedPemsValid(
                $generator->process()->getDOMDocument()->saveXML(),
                $keystore
            )
        );
    }
}
