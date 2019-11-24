<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Tests\Helper\XmlSec;

trait RSASignatureVerifyTrait
{
    private $xmlsecInstalled = null;

    private $saveDir = '/tmp';

    private function checkXmlSecInstalled(): void
    {
        if ($this->xmlsecInstalled === null) {
            $this->xmlsecInstalled = XmlSec::isInstalled();
        }
        if (!$this->xmlsecInstalled) {
            $this->markTestSkipped('XmlSec not installed,test skipped');
        }
    }

    private function isSignatureWithKeyValueValid(string $body): bool
    {
        \file_put_contents(
            $filename = \sprintf('/tmp/%s.xml', RandomString::get()),
            $body
            );
        $output = \shell_exec("xmlsec1 --verify {$filename} 2>&1");

        return XmlSec::isOutputValid($output);
    }

    private function isSignatureWithTrustedPemsValid(string $body, Keystore $keystore): bool
    {
        \file_put_contents(
            $filename = sprintf('%s/%s.xml', $this->saveDir, RandomString::get()),
            $body
        );
        $trustedPems = $this->saveTrustedPems($keystore);
        $output = XmlSec::verifyFileWithTrustedPems($filename, $trustedPems);

        return XmlSec::isOutputValid($output);
    }

    private function saveTrustedPems(Keystore $keystore, ?string $saveDir = null): array
    {
        $saveDir = $saveDir ?? $this->saveDir;

        $result = [];
        if ($keystore->getCertificate()) {
            \file_put_contents($filename = sprintf(
                '%s/%s.xml',
                $saveDir,
                RandomString::get()), $keystore->getCertificate()->export());
            $result[] = $filename;
        }
        if ($keystore->getExtraCerts()) {
            foreach ($keystore->getExtraCerts() as $extraCert) {
                /** @var \Budkovsky\OpenSslWrapper\X509 $extraCert */
                \file_put_contents($filename = sprintf(
                    '%s/%s.xml',
                    $saveDir,
                    RandomString::get()),
                    $extraCert->export()
                );
                $result[] = $filename;
            }
        }

        return $result;
    }

    abstract public static function markTestSkipped(string $message = ''): void;
}

