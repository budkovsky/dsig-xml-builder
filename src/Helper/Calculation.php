<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Helper;

use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
use Budkovsky\DsigXmlBuilder\Exception\PemException;

/**
 * Helper for signature calculations
 */
abstract class Calculation
{
    /**
     * Calculates digest value for content to be signed
     *
     * @param string $algorithm
     * @param string $data
     * @param bool $rawOutput
     * @return string
     */
    public static function getDigestValue(string $algorithm, string $data, bool $rawOutput = false): string
    {
        return hash(
            DigestAlgorithm::map($algorithm),
            $data,
            $rawOutput
        );
    }

    /**
     * Prepares content to canonicalization
     * @param string $content
     * @return string
     */
    public static function preCanonicalize(string $content): string
    {
        return \str_replace(
            ["\r\n", "\r", "&", "<", ">"],
            ["\n", "\n", "&amp;", "&lt;", "&gt;"],
            \mb_convert_encoding(\html_entity_decode($content), 'UTF-8')
        );
    }

    /**
     * Removes *BEGIN* and *END* markers from PEM body
     * @param string $body
     * @throws PemException
     * @return string
     */
    public static function trimPemBody(string $body): string
    {
        $matches = [];
        $pattern = '/-----BEGIN.*?-----(.*?)-----END.*?-----/s';
        \preg_match($pattern, $body, $matches);
        $trimmedBody = isset($matches[1]) && !empty($matches[1])
            ? \str_replace(["\n", "\r"], ['', ''], trim($matches[1]))
            : $body
        ;

        if (!Restriction::isBase64($trimmedBody)) {
            throw new PemException('PEM body is not base64 string');
        }

        return $trimmedBody;
    }
}
