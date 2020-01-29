<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Facade;

use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopedSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleKey;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Tests\Partial\RSASignatureVerifyTrait;
use Budkovsky\OpenSslWrapper\PrivateKey;
use PHPUnit\Framework\TestCase;
use Budkovsky\OpenSslWrapper\Keystore;

class EnvelopedRSASignatureGeneratorTest extends TestCase
{
    use CreationTestTrait;
    use RSASignatureVerifyTrait;

    protected function setUp(): void
    {
        $this->class = RSAEnvelopedSignatureGenerator::class;
    }

    /**
     * @see https://www.di-mgt.com.au/xmldsig.html
     */
    public function testCanGenerateEnvelopedXmlSignature(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopedSignatureGenerator::create()
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(Keystore::create()->setPrivateKey(PrivateKey::create()))
            ->loadDocument('<document xmlns="http://example.org/envelope"><body>aaaaa</body></document>')
        ;

        $pkey = new PrivateKey();
        $pkey->load($body);

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testCanGenerateEnvelopedXmlSignatureWithCertificateChain(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopedSignatureGenerator::create()
            ->setKeystore($keystore = ExampleKey::getKeystore())
            ->loadDocument('<document xmlns="http://example.org/envelope"><body>aaaaa</body></document>')
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
