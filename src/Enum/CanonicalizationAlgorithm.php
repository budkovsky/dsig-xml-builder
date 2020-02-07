<?php
declare(strict_types=1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;
use Budkovsky\DsigXmlBuilder\Exception\CanonicalizationAlgorithmException;

/**
 * XML canonicalization algorithm enumeration
 * @see https://www.w3.org/TR/xmldsig-core/#sec-c14nAlg
 */
abstract class CanonicalizationAlgorithm extends EnumAbstract
{
    const XML_1_0 = Algorithm::CANONICALIZATION_1_0;
    const XML_1_0_WITH_COMMENTS = Algorithm::CANONICALIZATION_1_0_WITH_COMMENTS;

    const XML_1_1 = Algorithm::CANONICALIZATION_1_1;
    const XML_1_1_WITH_COMMENTS = Algorithm::CANONICALIZATION_1_1_WITH_COMMENTS;

    const XML_1_0_EXCLUSIVE = Algorithm::CANONICALIZATION_1_0_EXCLUSIVE;
    const XML_1_0_EXCLUSIVE_WITH_COMMENTS = Algorithm::CANONICALIZATION_1_0_EXCLUSIVE_WITH_COMMENTS;

    public static function getAll(): array
    {
        return [
            'XML_1_0' => self::XML_1_0,
            'XML_1_0_WITH_COMMENTS' => self::XML_1_0_WITH_COMMENTS,
            'XML_1_1' => self::XML_1_1,
            'XML_1_1_WITH_COMMENTS' => self::XML_1_1_WITH_COMMENTS,
            'XML_1_0_EXCLUSIVE' => self::XML_1_0_EXCLUSIVE,
            'XML_1_0_EXCLUSIVE_WITH_COMMENTS' => self::XML_1_0_EXCLUSIVE_WITH_COMMENTS
        ];
    }

    public static function map(string $algorithm): int
    {
        if (!self::isValid($algorithm)) {
            throw new CanonicalizationAlgorithmException(
                "Invalid canonicalization method algorithm: `$algorithm`"
            );
        }

        switch ($algorithm) {
            case self::XML_1_0_WITH_COMMENTS:
            case self::XML_1_1_WITH_COMMENTS:
                $result = C14nFlag::WITH_COMMENTS;
                break;

            case self::XML_1_0_EXCLUSIVE:
                $result = C14nFlag::EXCLUSIVE;
                break;

            case self::XML_1_0_EXCLUSIVE_WITH_COMMENTS:
                $result = C14nFlag::EXCLUSIVE | C14nFlag::WITH_COMMENTS;
                break;

            case self::XML_1_0:
            case self::XML_1_1:
                $result = C14nFlag::NORMAL;
                break;
        }

        return $result;
    }
}
