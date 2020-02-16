<?php
declare(strict_types=1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;
use Budkovsky\DsigXmlBuilder\Exception\DigestAlgorithmException;

/**
 * Message digest algorithm enumeration
 * @see https://www.w3.org/TR/xmldsig-core/#sec-MessageDigests
 */
abstract class DigestAlgorithm extends EnumAbstract
{
    private static $mapper = [
        self::SHA1 => 'sha1',
        self::SHA224 => 'sha224',
        self::SHA256 => 'sha256',
        self::SHA384 => 'sha384',
        self::SHA512 => 'sha512'
    ];

    const SHA1 = Algorithm::SHA1;
    const SHA224 = Algorithm::SHA224;
    const SHA256 = Algorithm::SHA256;
    const SHA384 = Algorithm::SHA384;
    const SHA512 = Algorithm::SHA512;

    /**
     * List of available message digest algorithms
     * @return array
     */
    public static function getAll(): array
    {
        return [
            'SHA1' => self::SHA1,
            'SHA224' => self::SHA224,
            'SHA256' => self::SHA256,
            'SHA384' => self::SHA384,
            'SHA512' => self::SHA512
        ];
    }

    /**
     * Maps DigestMethod algorithm to hash method
     *
     * @SuppressWarnings(PHPMD.UndefinedVariable)
     *
     * @param string $algorithm
     * @throws DigestAlgorithmException
     * @return string
     */
    public static function map(string $algorithm): string
    {
        if (!self::isValid($algorithm)) {
            throw new DigestAlgorithmException("Invalid algortihm for DigestMethod: `{$algorithm}`");
        }

        return self::$mapper[$algorithm];
    }
}
