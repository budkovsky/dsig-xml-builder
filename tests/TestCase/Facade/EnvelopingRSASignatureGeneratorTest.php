<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Facade;

use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\OpenSslWrapper\PrivateKey;
use PHPUnit\Framework\TestCase;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Facade\EnvelopingRSASignatureGenerator;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleKey;
use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\DsigXmlBuilder\Tests\Partial\XmlSecTrait;

class EnvelopingRSASignatureGeneratorTest extends TestCase
{
    use CreationTestTrait;
    use XmlSecTrait;

    protected function setUp(): void
    {
        $this->class = EnvelopingRSASignatureGenerator::class;
        $this->setXmlSecStatus();
    }

    /**
	 * @see https://www.di-mgt.com.au/xmldsig.html
	 */
    public function testCanGenerateEnvelopingXmlSignature(): void
    {
        $this->checkXmlSecInstalled();

        $generator = EnvelopingRSASignatureGenerator::create()->setContent("some\r\ncontent");
        $generator->getKeystore()->setPrivateKey(PrivateKey::create());
        $generator->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE);

        /** @var \DOMDocument $document */
        $document = $generator->process()->getDOMDocument();
        //$document->getElementsByTagName('object')[0]->nodeValue = 'abdefgh';

        $filename = sprintf('/tmp/%s.xml', RandomString::get());

        $document->save($filename);

        $output = \shell_exec("xmlsec1 --verify {$filename} 2>&1");

        $this->assertRegExp('/^OK.*$/s', $output);

    }

    public function testCanGenerateEnvelopingXmlSignatureWithCertificateChain(): void
    {
        $this->checkXmlSecInstalled();

        $keystore = ExampleKey::getKeystore();

        $trustedPemList = $this->saveTrustedPems($keystore);

        $generator = EnvelopingRSASignatureGenerator::create()->setContent("some\r\ncontent");
        $generator->setKeystore($keystore);
        $generator->setKeyInfoMode(KeyInfoMode::RSA_X509DATA_CERTIFICATE);

        /** @var \DOMDocument $document */
        $document = $generator->process()->getDOMDocument();
        //$document->getElementsByTagName('object')[0]->nodeValue = 'abdefgh';

        $filename = sprintf('/tmp/%s.xml', RandomString::get());


        $document->save($filename);

        $command = sprintf(
            'xmlsec1 --verify %s %s 2>&1',
            (function() use ($trustedPemList) {
                $result = [];
                foreach($trustedPemList as $pem) {
                    $result[] = "--trusted-pem $pem";
                }

                return implode(' ', $result);
            })(),
            $filename
        );

        $output = \shell_exec($command);


        $this->assertRegExp('/^OK.*$/s', $output);

    }

    protected function saveTrustedPems(Keystore $keystore): array
    {
        $result = [];
        if ($keystore->getCertificate()) {
            \file_put_contents($filename = sprintf('/tmp/%s.xml', RandomString::get()), $keystore->getCertificate()->export());
            $result[] = $filename;
        }
        if ($keystore->getExtraCerts()) {
            foreach ($keystore->getExtraCerts() as $extraCert) {
                /** @var \Budkovsky\OpenSslWrapper\X509 $extraCert */
                \file_put_contents($filename = sprintf('/tmp/%s.xml', RandomString::get()), $extraCert->export());
                $result[] = $filename;
            }
        }

        return $result;
    }

    protected function checkXmlSecInstalled(): void
    {
        if (!$this->xmlsecInstalled) {
            $this->markTestSkipped('XmlSec not installed,test skipped');
        }
    }
}
