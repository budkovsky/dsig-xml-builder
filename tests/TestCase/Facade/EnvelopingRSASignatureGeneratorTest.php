<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Facade;

use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleKey;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Tests\Partial\RSASignatureVerifyTrait;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\OpenSslWrapper\PrivateKey;
use PHPUnit\Framework\TestCase;

class EnvelopingRSASignatureGeneratorTest extends TestCase
{
    use CreationTestTrait;
    use RSASignatureVerifyTrait;

    protected function setUp(): void
    {
        $this->class = RSAEnvelopingSignatureGenerator::class;
    }

    /**
	 * @see https://www.di-mgt.com.au/xmldsig.html
	 */
    public function testCanGenerateEnvelopingXmlSignature(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setContent("some\r\ncontent")
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

    public function testCanGenerateEnvelopingXmlSignatureWithCertificateChain(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setContent("some\r\ncontent")
            ->setKeystore($keystore = ExampleKey::getKeystore())
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
