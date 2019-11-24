<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\Aid\Collection\StringNamedCollection;
use Budkovsky\OpenSslWrapper\Keystore;

class XmlSec
{
    public static function isInstalled(): bool
    {
        return (bool)\preg_match(
            '/xmlsec1 \d\.\d\.\d{1,2}/',
            \shell_exec("xmlsec1 --version 2>&1")
        );
    }

    public static function saveCerts(Keystore $keystore, string $dir = '/tmp'): StringNamedCollection
    {
        //$collection = new StringNamedCollection();
    }

    public static function verifyFile(string $filename): string
    {
        return self::verify($filename);
    }

    public static function verifyFileWithTrustedPems(string $filename, array $trustedPems): string
    {
        $parameters = [];
        foreach ($trustedPems as $pem) {
            $parameters[] = "--trusted-pem {$pem}";
        }
        $parameters[] = $filename;

        return self::verify(\implode(' ', $parameters));
    }

    public static function isOutputValid(string $output): bool
    {
        return (bool)\preg_match('/^OK.*$/s', $output);
    }

    private static function verify(string $parameters): string
    {
        return \shell_exec("xmlsec1 --verify {$parameters} 2>&1");
    }
}
