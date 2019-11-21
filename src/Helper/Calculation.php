<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Helper;

use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
use Budkovsky\DsigXmlBuilder\Exception\PemException;

abstract class Calculation
{
    public static function getDigestValue(string $algorithm, string $data, bool $rawOutput = false): string
    {
        return hash(
            DigestAlgorithm::map($algorithm),
            $data,
            $rawOutput
        );
    }

    public static function preCanonicalize(string $content): string
    {
        return \str_replace(
            ["\r\n", "\r", "&", "<", ">"],
            ["\n", "\n", "&amp;", "&lt;", "&gt;"],
            \mb_convert_encoding(\html_entity_decode($content), 'UTF-8')
        );
    }

    public static function trimPemBody(string $body): string
    {
        $matches = [];
        $pattern = '/-----BEGIN.*?-----(.*?)-----END.*?-----/s';
        \preg_match($pattern, $body, $matches);
        $trimmedBody = \str_replace(["\n", "\r"], ['', ''], trim($matches[1]));



        if (!Restriction::isBase64($trimmedBody)) {
            throw new PemException('PEM body is not base64 string');
        }

        return $trimmedBody;
    }
}
