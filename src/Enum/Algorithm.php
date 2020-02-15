<?php
namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;

/**
 * Enumeration of the algorithms
 */
class Algorithm extends EnumAbstract
{
    const BASE64 = 'http://www.w3.org/2000/09/xmldsig#base64';

    const SHA1 = 'http://www.w3.org/2000/09/xmldsig#sha1';
    const SHA256 = 'http://www.w3.org/2001/04/xmlenc#sha256';
    const SHA224 = 'http://www.w3.org/2001/04/xmldsig-more#sha224';
    const SHA384 = 'http://www.w3.org/2001/04/xmldsig-more#sha384';
    const SHA512 = 'http://www.w3.org/2001/04/xmlenc#sha512';

    const HMAC_SHA1 = 'http://www.w3.org/2000/09/xmldsig#hmac-sha1';
    const HMAC_SHA256 = 'http://www.w3.org/2001/04/xmldsig-more#hmac-sha256';
    const HMAC_SHA384 = 'http://www.w3.org/2001/04/xmldsig-more#hmac-sha384';
    const HMAC_SHA512 = 'http://www.w3.org/2001/04/xmldsig-more#hmac-sha512';
    const HMAC_SHA224 = 'http://www.w3.org/2001/04/xmldsig-more#hmac-sha224';

    const DSA_SHA1 = 'http://www.w3.org/2000/09/xmldsig#dsa-sha1';
    const DSA_SHA256 = 'http://www.w3.org/2009/xmldsig11#dsa-sha256';

    const RSA_SHA1 = 'http://www.w3.org/2000/09/xmldsig#rsa-sha1';
    const RSA_SHA256 = 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256';
    const RSA_SHA224 = 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha224';
    const RSA_SHA384 = 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha384';
    const RSA_SHA512 = 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha512';

    const ECDSA_SHA1 = 'http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha1';
    const ECDSA_SHA256 = 'http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha256';
    const ECDSA_SHA224 = 'http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha224';
    const ECDSA_SHA384 = 'http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha384';
    const ECDSA_SHA512 = 'http://www.w3.org/2001/04/xmldsig-more#ecdsa-sha512';

    const CANONICALIZATION_1_0 = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
    const CANONICALIZATION_1_1 = 'http://www.w3.org/2006/12/xml-c14n11';
    const CANONICALIZATION_1_0_EXCLUSIVE = 'http://www.w3.org/2001/10/xml-exc-c14n#';
    const CANONICALIZATION_1_0_WITH_COMMENTS = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments';
    const CANONICALIZATION_1_1_WITH_COMMENTS = 'http://www.w3.org/2006/12/xml-c14n11#WithComments';
    const CANONICALIZATION_1_0_EXCLUSIVE_WITH_COMMENTS = 'http://www.w3.org/2001/10/xml-exc-c14n#WithComments';

    /**
     * {@inheritdoc}
     */
    public static function getAll(): array
    {
        return [
            'SHA1' => self::SHA1,
            'SHA256' => self::SHA256,
            'SHA224' => self::SHA224,
            'SHA384' => self::SHA384,
            'SHA512' => self::SHA512,

            'HMAC_SHA1' => self::HMAC_SHA1,
            'HMAC_SHA256' => self::HMAC_SHA256,
            'HMAC_SHA384' => self::HMAC_SHA384,
            'HMAC_SHA512' => self::HMAC_SHA512,
            'HMAC_SHA224' => self::HMAC_SHA224,

            'DSA_SHA1' => self::DSA_SHA1,
            'DSA_SHA256' => self::DSA_SHA256,

            'RSA_SHA1' => self::RSA_SHA1,
            'RSA_SHA256' => self::RSA_SHA256,
            'RSA_SHA224' => self::RSA_SHA224,
            'RSA_SHA384' => self::RSA_SHA384,
            'RSA_SHA512' => self::RSA_SHA512,

            'ECDSA_SHA1' => self::ECDSA_SHA1,
            'ECDSA_SHA256' => self::ECDSA_SHA256,
            'ECDSA_SHA224' => self::ECDSA_SHA224,
            'ECDSA_SHA384' => self::ECDSA_SHA384,
            'ECDSA_SHA512' => self::ECDSA_SHA512,

            'CANONICALIZATION_1_0' => self::CANONICALIZATION_1_0,
            'CANONICALIZATION_1_1' => self::CANONICALIZATION_1_1,
            'CANONICALIZATION_1_0_EXCLUSIVE' => self::CANONICALIZATION_1_0_EXCLUSIVE,
            'CANONICALIZATION_1_0_WITH_COMMENTS' => self::CANONICALIZATION_1_0_WITH_COMMENTS,
            'CANONICALIZATION_1_1_WITH_COMMENTS' => self::CANONICALIZATION_1_1_WITH_COMMENTS,
            'CANONICALIZATION_1_0_EXCLUSIVE_WITH_COMMENTS' => self::CANONICALIZATION_1_0_EXCLUSIVE_WITH_COMMENTS,
        ];
    }
}
