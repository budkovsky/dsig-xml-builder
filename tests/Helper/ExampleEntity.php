<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\ManifestType;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\SPKISexp;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SKI;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\KeyName;

class ExampleEntity
{
    public static function getSignature(): SignatureType
    {
        return SignatureType::create()
            ->setSignedInfo(self::getSignedInfo())
            ->setSignatureValue(self::getSignatureValue())
        ;
    }

    public static function getSignatureValue(): SignatureValueType
    {
        return SignatureValueType::create()
            ->setSimpleContent(\base64_encode(RandomString::get(1000)))
        ;
    }

    public static function getSignedInfo(): SignedInfoType
    {
        return SignedInfoType::create()
            ->setCanonicalizationMethod(self::getCanonicalizationMethod())
            ->setSignatureMethod(self::getSignatureMethod())
            ->addReference(self::getReference())
        ;
    }

    public static function getCanonicalizationMethod(): CanonicalizationMethodType
    {
        return CanonicalizationMethodType::create()
            ->setAlgorithmAttribute('http://www.aaa.com#sha1')
        ;
    }

    public static function getSignatureMethod(): SignatureMethodType
    {
        return SignatureMethodType::create()
            ->setAlgorithmAttribute('http://www.bbb.com#md5')
        ;
    }

    public static function getReference(): ReferenceType
    {
        return ReferenceType::create()
            ->setDigestMethod(self::getDigestMethod())
            ->setDigestValue(\base64_encode(RandomString::get()))
        ;
    }

    public static function getTransform(): TransformType
    {
        return TransformType::create()
            ->setAlgorithmAttribute('http://aaa.bbb.com/ccc#xyz')
        ;
    }

    public static function getDigestMethod(): DigestMethodType
    {
        return DigestMethodType::create()
            ->setAlgorithmAttribute('http://www.w3.org/2000/09/xmldsig#rsa-sha1')
        ;
    }

    public static function getKeyInfo(): KeyInfoType
    {
        return KeyInfoType::create()->addChild(
            KeyName::create()->setSimpleContent(RandomString::get())
        );
    }

    public static function getKeyValue(): KeyValueType
    {
        return KeyValueType::create()
            ->setRsaKeyValue(self::getRSAKeyValue())
        ;
    }

    public static function getRetrievalMethod(): RetrievalMethodType
    {
        return RetrievalMethodType::create()
            ->setUriAttribute('http://xxx.com/zzz#abcd')
        ;
    }

    public static function getX509DataType(): X509DataType
    {
        return X509DataType::create()
            ->addChild(
                X509SKI::create()
                    ->setSimpleContent(RandomString::get(64))
            )
        ;
    }

    public static function getX509IssuerSerial(): X509IssuerSerialType
    {
        return X509IssuerSerialType::create()
            ->setX509IssuerName(RandomString::get())
            ->setX509SerialNumber(\rand(1,1000))
        ;
    }

    public static function getPGPData(): PGPDataType
    {
        return PGPDataType::create()
            ->setPgpKeyId(
                \base64_encode(RandomString::get(127))
            )
        ;
    }

    public static function getSPKIData(): SPKIDataType
    {
        return SPKIDataType::create()
            ->addChild(
                SPKISexp::create()
                    ->setSimpleContent(
                        \base64_encode(RandomString::get(1000))
                    )
            )
        ;
    }

    public static function getObject(): ObjectType
    {
        return ObjectType::create()
            ->setIdAttribute('qwe1234')
            ->setMimeType('application/xml')
            ->setEncoding('http://eeee.com#UTF8')
        ;
    }

    public static function getManifest(): ManifestType
    {
        return ManifestType::create()
            ->addReference(self::getReference())
        ;
    }

    public static function getSignatureProperties(): SignaturePropertiesType
    {
        return SignaturePropertiesType::create()->addSignatureProperty(self::getSignatureProperty());
    }

    public static function getSignatureProperty(): SignaturePropertyType
    {
        return SignaturePropertyType::create()
            ->setTargetAttribute('http://aaa.com/bbb#ccc')
            ->addChild(self::getAnyEntity())
        ;
    }

    public static function getDSAKeyValue(): DSAKeyValueType
    {
        return DSAKeyValueType::create()
            ->setY(\base64_encode(RandomString::get()))
        ;
    }

    public static function getRSAKeyValue(): RSAKeyValueType
    {
        return RSAKeyValueType::create()
            ->setExponent(\base64_encode(RandomString::get()))
            ->setModulus(\base64_encode(RandomString::get()))
        ;
    }

    public static function getAnyEntity(): EntityInterface
    {
        return ExampleAnyType::create()
            ->setSubelement1(RandomString::get(16))
            ->setSubelement2(RandomString::get(16))
        ;
    }
}
