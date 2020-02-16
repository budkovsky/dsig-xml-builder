<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Partial;

use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\OpenSslWrapper\PrivateKey;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\RSASignatureVerifyTrait;
use Budkovsky\DsigXmlBuilder\Enum\CanonicalizationAlgorithm;
use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
use Budkovsky\DsigXmlBuilder\Enum\SignatureAlgorithm;
use Budkovsky\DsigXmlBuilder\Exception\CanonicalizationAlgorithmException;
use Budkovsky\DsigXmlBuilder\Exception\DigestAlgorithmException;
use Budkovsky\DsigXmlBuilder\Exception\SignatureAlgorithmException;

class GeneratorPropertyTraitTest extends TestCase
{
    use RSASignatureVerifyTrait;

    public function testGeneratorCanSetCanonicalizationAlgorithm(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setCanonicalizationAlgorithm(CanonicalizationAlgorithm::XML_1_1)
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;
        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testThrowExceptionOnInvalidCanonicalizationAlgorithm(): void
    {
        $this->expectException(CanonicalizationAlgorithmException::class);
        RSAEnvelopingSignatureGenerator::create()->setCanonicalizationAlgorithm('invalid-algorithm');
    }

    public function testGeneratorCanSetDigestAlgorithm(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setDigestAlgorithm(DigestAlgorithm::SHA512)
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;
        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testThrowExceptionOnInvalidDigestAlgorithm(): void
    {
        $this->expectException(DigestAlgorithmException::class);
        RSAEnvelopingSignatureGenerator::create()->setDigestAlgorithm('invalid-algorithm2');
    }

    public function testGeneratorCanSetSignatureAlgorithm(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setSignatureAlgorithm(SignatureAlgorithm::RSA_SHA384)
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;
        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testThrowExceptionOnInvalidSignatureAlgorithm(): void
    {
        $this->expectException(SignatureAlgorithmException::class);
        RSAEnvelopingSignatureGenerator::create()->setSignatureAlgorithm('invalid-algorithm3');
    }

    public function testGeneratorCanSetSignatureId(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setSignatureId($signatureId = 'abcdefgh')
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testGeneratorCanSetContentId(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setContentId('xyzxyz')
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                   $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testGeneratorCanSetSignatureValueId(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setSignatureValueId('my-signature-value-id')
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->getDOMDocument()->saveXML()
            )
        );
    }

    public function testCanReturnSignatureAsAString(): void
    {
        $this->checkXmlSecInstalled();

        $generator = RSAEnvelopingSignatureGenerator::create()
            ->setSignatureValueId('my-signature-value-id')
            ->setContent("some\r\ncontent")
            ->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE)
            ->setKeystore(
                Keystore::create()->setPrivateKey(PrivateKey::create())
            )
        ;

        $this->assertTrue(
            $this->isSignatureWithKeyValueValid(
                $generator->process()->get()
            )
        );
    }
}
