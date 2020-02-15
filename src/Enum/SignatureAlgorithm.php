<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;
use Budkovsky\DsigXmlBuilder\Exception\SignatureAlgorithmException;

/**
 * Signature algorithm enumeration
 * @see https://www.w3.org/TR/xmldsig-core/#sec-SignatureAlg
 */
abstract class SignatureAlgorithm extends EnumAbstract
{

    private const MAPPER = [
        self::RSA_SHA1 => 'sha1WithRSAEncryption',
        self::RSA_SHA224 => 'sha224WithRSAEncryption',
        self::RSA_SHA256 => 'sha256WithRSAEncryption',
        self::RSA_SHA384 => 'sha384WithRSAEncryption',
        self::RSA_SHA512 => 'sha512WithRSAEncryption',
        self::SHA1 => 'sha1'
    ];

    //DSA
    const SHA1 = Algorithm::SHA1;
//    const DSA_SHA256 = Algorithm::DSA_SHA256;

    //RSA
    const RSA_SHA1 = Algorithm::RSA_SHA1;
    const RSA_SHA224 = Algorithm::RSA_SHA224;
    const RSA_SHA256 = Algorithm::RSA_SHA256;
    const RSA_SHA384 = Algorithm::RSA_SHA384;
    const RSA_SHA512 = Algorithm::RSA_SHA512;

    //ECDSA
//     const ECDSA_SHA1 = Algorithm::ECDSA_SHA1;
//     const ECDSA_SHA224 = Algorithm::ECDSA_SHA224;
//     const ECDSA_SHA256 = Algorithm::ECDSA_SHA256;
//     const ECDSA_SHA384 = Algorithm::ECDSA_SHA384;
//     const ECDSA_SHA512 = Algorithm::ECDSA_SHA512;

    /**
     * List of available signature algorithms
     * @return array
     */
    public static function getAll(): array
    {
        return [
             'SHA1' => self::SHA1,
//             'DSA_SHA256' => self::DSA_SHA256,
            'RSA_SHA1' => self::RSA_SHA1,
            'RSA_SHA224' => self::RSA_SHA224,
            'RSA_SHA256' => self::RSA_SHA256,
            'RSA_SHA384' => self::RSA_SHA384,
            'RSA_SHA512' => self::RSA_SHA512,
//             'ECDSA_SHA1' => self::ECDSA_SHA1,
//             'ECDSA_SHA224' => self::ECDSA_SHA224,
//             'ECDSA_SHA256' => self::ECDSA_SHA256,
//             'ECDSA_SHA384' => self::ECDSA_SHA384,
//             'ECDSA_SHA512' => self::ECDSA_SHA512
        ];
    }

    /**
     * Maps XML signature algorithm to PHP sign algorithm
     *
     * @param string $algorithm
     * @throws SignatureAlgorithmException
     * @return string
     */
    public static function map(string $algorithm): string
    {
        if (!self::isValid($algorithm)) {
            throw new SignatureAlgorithmException("Invalid signature algorithm: `{$algorithm}`");
        }

        return self::MAPPER[$algorithm];
    }
}
