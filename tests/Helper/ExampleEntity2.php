<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;

/** @see https://www.di-mgt.com.au/xmldsig.html */
class ExampleEntity2
{
    public static $digestValue = 'OPnpF/ZNLDxJ/I+1F3iHhlmSwgo=';

    public static function getSignature(): SignatureType
    {
        return SignatureType::create()
            ->setSignedInfo(self::getSignedInfo())
            ->setSignatureValue(self::getSignatureValue())
            ->setKeyInfo(self::getKeyInfo())
            ->addObject(self::getObject())
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
        return CanonicalizationMethodType::create()->setAlgorithmAttribute('http://www.w3.org/TR/2001/REC-xml-c14n-20010315');
    }

    public  static function getSignatureMethod(): SignatureMethodType
    {
        return SignatureMethodType::create()->setAlgorithmAttribute('http://www.w3.org/2000/09/xmldsig#rsa-sha1');
    }

    public static function getReference(): ReferenceType
    {
        return ReferenceType::create()
            ->setUriAttribute('#object')
            ->setDigestMethod(self::getDigestMethod())
            ->setDigestValue(self::$digestValue)
        ;
    }

    public static function getDigestMethod(): DigestMethodType
    {
        return DigestMethodType::create()->setAlgorithmAttribute('http://www.w3.org/2000/09/xmldsig#sha1');
    }

    public static function getSignatureValue(): SignatureValueType
    {
        return SignatureValueType::create()
            ->setSimpleContent('nihUFQg4mDhLgecvhIcKb9Gz8VRTOlw+adiZOBBXgK4JodEe5aFfCqm8WcRIT8GLLXSk8PsUP4//SsKqUBQkpotcAqQAhtz2v9kCWdoUDnAOtFZkd/CnsZ1sge0ndha40wWDV+nOWyJxkYgicvB8POYtSmldLLepPGMz+J7/Uws=')
        ;
    }

    public static function getKeyInfo(): KeyInfoType
    {
        return KeyInfoType::create()->addChild(self::getKeyValue());
    }

    public static function getKeyValue(): KeyValueType
    {
        return KeyValueType::create()->setRsaKeyValue(self::getRSAKeyValue());
    }

    public static function getRSAKeyValue(): RSAKeyValueType
    {
        return RSAKeyValueType::create()
            ->setModulus('4IlzOY3Y9fXoh3Y5f06wBbtTg94Pt6vcfcd1KQ0FLm0S36aGJtTSb6pYKfyX7PqCUQ8wgL6xUJ5GRPEsu9gyz8ZobwfZsGCsvu40CWoT9fcFBZPfXro1Vtlh/xl/yYHm+Gzqh0Bw76xtLHSfLfpVOrmZdwKmSFKMTvNXOFd0V18=')
            ->setExponent('AQAB')
        ;

    }

    public static function getObject(): ObjectType
    {
        $simpleContent = hex2bin(implode(null, [
            //'3C4F626A65637420786D6C6E733D22687474703A2F2F7777',
            //'772E77332E6F72672F323030302F30392F786D6C64736967',
            //'23222049643D226F626A656374223E',
            '736F6D652074657874',
            '0A2020776974682073706163657320616E642043522D4C46',
            '2E',
            //'3C2F4F626A6563743E'
        ]));

        return ObjectType::create()
            ->setIdAttribute('object')
            ->setSimpleContent($simpleContent);
    }
}
