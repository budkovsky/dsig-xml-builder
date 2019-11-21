<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Facade;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\XmlSecTrait;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Facade\EnvelopedRSASignatureGenerator;
use Budkovsky\OpenSslWrapper\PrivateKey;
use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\Aid\Helper\RandomString;

class EnvelopedRSASignatureGeneratorTest extends TestCase
{
    use CreationTestTrait;
    use XmlSecTrait;

    protected function setUp(): void
    {
        $this->class = EnvelopedRSASignatureGenerator::class;
        $this->setXmlSecStatus();
    }

    /**
     * @see https://www.di-mgt.com.au/xmldsig.html
     */
    public function testCanGenerateEnvelopedXmlSignature(): void
    {
        $this->checkXmlSecInstalled();

        $generator = EnvelopedRSASignatureGenerator::create()
            //->loadDocument(\file_get_contents(__DIR__.'/../../../docs/example/enveloped/envelope.xml'))
            ->loadDocument('<document xmlns="http://example.org/envelope"><body>aaaaa</body></document>')
        ;

        $generator->getKeystore()->setPrivateKey(PrivateKey::create());
        $generator->setKeyInfoMode(KeyInfoMode::RSA_KEY_VALUE);

        /** @var \DOMDocument $document */
        $document = $generator->process()->getDOMDocument();
        //$document->getElementsByTagName('object')[0]->nodeValue = 'abdefgh';
        $filename = sprintf('/tmp/%s.xml', RandomString::get());
        $document->save($filename);

        $filename = \realpath($filename);

        $this->assertNotEmpty($filename);
        $this->assertIsString($filename);
        $this->assertGreaterThan(0, \strlen($filename));

        $output = \shell_exec("xmlsec1 --verify {$filename} 2>&1");

        $this->assertRegExp('/^OK.*$/s', $output);
    }
}
