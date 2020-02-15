<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;

/**
 * Enumeration of XML tags available in digital signature
 */
class Tag extends EnumAbstract
{
    const SIGNATURE_ELEMENT = 'Signature';
    const SIGNED_INFO_ELEMENT = 'SignedInfo';
    const SIGNATURE_VALUE_ELEMENT = 'SignatureValue';
    const KEY_INFO_ELEMENT = 'KeyInfo';
    const OBJECT_ELEMENT = 'Object';
    const CANONICALIZATION_METHOD_ELEMENT = 'CanonicalizationMethod';
    const SIGNATURE_METHOD_ELEMENT = 'SignatureMethod';
    const REFERENCE_ELEMENT = 'Reference';
    const TRANSFORMS_ELEMENT = 'Transforms';
    const TRANSFORM_ELEMENT = 'Transform';
    const DIGEST_METHOD_ELEMENT = 'DigestMethod';
    const DIGEST_VALUE_ELEMENT = 'DigestValue';
    const KEY_NAME_ELEMENT = 'KeyName';
    const KEY_VALUE_ELEMENT = 'KeyValue';
    const DSA_KEY_VALUE_ELEMENT = 'DSAKeyValue';
    const RSA_KEY_VALUE_ELEMENT = 'RSAKeyValue';
    const MODULUS_ELEMENT = 'Modulus';
    const EXPONENT_ELEMENT = 'Exponent';
    const RETRIEVAL_METHOD_ELEMENT = 'RetrievalMethod';
    const X509_DATA_ELEMENT = 'X509Data';
    const X509_SKI_ELEMENT = 'X509SKI';
    const X509_SUBJECT_NAME_ELEMENT = 'X509SubjectName';
    const X509_CERTIFICATE_ELEMENT = 'X509Certificate';
    const X509_CRL_ELEMENT = 'X509CRL';
    const X509_ISSUER_SERIAL_ELEMENT = 'X509IssuerSerial';
    const X509_ISSUER_NAME_ELEMENT = 'X509IssuerName';
    const X509_SERIAL_NUMBER_ELEMENT = 'X509SerialNumber';
    const PGP_DATA_ELEMENT = 'PGPData';
    const PGP_KEY_ID_ELEMENT = 'PGPKeyID';
    const PGP_KEY_PACKET_ELEMENT = 'PGPKeyPacket';
    const SPKI_DATA_ELEMENT = 'SPKIData';
    const MGMT_DATA_ELEMENT = 'MgmtData';
    const SPKI_SEXP_ELEMENT = 'SPKISexp';
    const XPATH_ELEMENT = 'XPath';
    const P_ELEMENT = 'P';
    const Q_ELEMENT = 'Q';
    const G_ELEMENT = 'G';
    const Y_ELEMENT = 'Y';
    const J_ELEMENT = 'J';
    const SEED_ELEMENT = 'Seed';
    const PGEN_COUNTER_ELEMENT = 'PgenCounter';
    const SIGNATURE_PROPERTY_ELEMENT = 'SignatureProperty';
    const SIGNATURE_PROPERTIES_ELEMENT = 'SignatureProperties';
    const MANIFEST_ELEMENT = 'Manifest';
    const HMAC_OUTPUT_LENGTH_ELEMENT = 'HMACOutputLength';

    /**
     * {@inheritdoc}
     */
    public static function getAll(): array
    {
        return [
            'SIGNATURE_ELEMENT' => self::SIGNATURE_ELEMENT,
            'SIGNEDINFO_ELEMENT' => self::SIGNED_INFO_ELEMENT,
            'SIGNATURE_VALUE_ELEMENT' => self::SIGNATURE_VALUE_ELEMENT,
            'KEY_INFO_ELEMENT' => self::KEY_INFO_ELEMENT,
            'OBJECT_ELEMENT' => self::OBJECT_ELEMENT,
            'CANONICALIZATION_METHOD_ELEMENT' => self::CANONICALIZATION_METHOD_ELEMENT,
            'SIGNATURE_METHOD_ELEMENT' => self::SIGNATURE_METHOD_ELEMENT,
            'REFERENCE_ELEMENT' => self::REFERENCE_ELEMENT,
            'TRANSFORMS_ELEMENT' => self::TRANSFORMS_ELEMENT,
            'TRANSFORM_ELEMENT' => self::TRANSFORM_ELEMENT,
            'DIGEST_METHOD_ELEMENT' => self::DIGEST_METHOD_ELEMENT,
            'DIGEST_VALUE_ELEMENT' => self::DIGEST_VALUE_ELEMENT,
            'KEY_NAME_ELEMENT' => self::KEY_NAME_ELEMENT,
            'KEY_VALUE_ELEMENT' => self::KEY_VALUE_ELEMENT,
            'DSA_KEY_VALUE_ELEMENT' => self::DSA_KEY_VALUE_ELEMENT,
            'RSA_KEY_VALUE_ELEMENT' => self::RSA_KEY_VALUE_ELEMENT,
            'MODULUS_ELEMENT' => self::MODULUS_ELEMENT,
            'EXPONENT_ELEMENT' => self::EXPONENT_ELEMENT,
            'RETRIEVAL_METHOD_ELEMENT' => self::RETRIEVAL_METHOD_ELEMENT,
            'X509_DATA_ELEMENT' => self::X509_DATA_ELEMENT,
            'X509_SKI_ELEMENT' => self::X509_SKI_ELEMENT,
            'X509_SUBJECT_NAME_ELEMENT' => self::X509_SUBJECT_NAME_ELEMENT,
            'X509_CERTIFICATE_ELEMENT' => self::X509_CERTIFICATE_ELEMENT,
            'X509_CRL_ELEMENT' => self::X509_CRL_ELEMENT,
            'X509_ISSUER_SERIAL_ELEMENT' => self::X509_ISSUER_SERIAL_ELEMENT,
            'X509_ISSUER_NAME_ELEMENT' => self::X509_ISSUER_NAME_ELEMENT,
            'X509_SERIAL_NUMBER_ELEMENT' => self::X509_ISSUER_SERIAL_ELEMENT,
            'PGP_DATA_ELEMENT' => self::PGP_DATA_ELEMENT,
            'PGP_KEY_ID_ELEMENT' => self::PGP_KEY_ID_ELEMENT,
            'PGP_KEY_PACKET_ELEMENT' => self::PGP_KEY_PACKET_ELEMENT,
            'SPKI_DATA_ELEMENT' => self::SPKI_DATA_ELEMENT,
            'MGMT_DATA_ELEMENT' => self::MGMT_DATA_ELEMENT,
            'SPKI_SEXP_ELEMENT' => self::SPKI_SEXP_ELEMENT,
            'XPATH_ELEMENT' => self::XPATH_ELEMENT,
            'P_ELEMENT' => self::P_ELEMENT,
            'Q_ELEMENT' => self::Q_ELEMENT,
            'G_ELEMENT' => self::G_ELEMENT,
            'Y_ELEMENT' => self::Y_ELEMENT,
            'J_ELEMENT' => self::J_ELEMENT,
            'SEED_ELEMENT' => self::SEED_ELEMENT,
            'PGEN_COUNTER' =>self::PGEN_COUNTER_ELEMENT,
            'SIGNATURE_PROPERTY_ELEMENT' => self::SIGNATURE_PROPERTY_ELEMENT,
            'SIGNATURE_PROPERTIES_ELEMENT' =>self::SIGNATURE_PROPERTIES_ELEMENT,
            'MANIFEST_ELEMENT' => self::MANIFEST_ELEMENT,
            'HMAC_OUTPUT_LENGTH_ELEMENT' => self::HMAC_OUTPUT_LENGTH_ELEMENT
        ];
    }
}
