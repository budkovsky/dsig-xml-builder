<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Helper;

/**
 * RestrictionHelper
 *
 */
abstract class RestrictionHelper
{
    //const REGEX_URI = '^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?';
    //const REGEX_URI = '/\\b(([\\w-]+://?|www[.])[^\\s()<>]+(?:\\([\\w\\d]+\\)|([^[:punct:]\\s]|/)))/iS';
    //const REGEX_URI = '/^([a-z0-9+.-]+):(?://(?:((?:[a-z0-9-._~!$&\'()*+,;=:]|%[0-9A-F]{2})*)@)?((?:[a-z0-9-._~!$&\'()*+,;=]|%[0-9A-F]{2})*)(?::(\d*))?(/(?:[a-z0-9-._~!$&\'()*+,;=:@/]|%[0-9A-F]{2})*)?|(/?(?:[a-z0-9-._~!$&\'()*+,;=:@]|%[0-9A-F]{2})+(?:[a-z0-9-._~!$&\'()*+,;=:@/]|%[0-9A-F]{2})*)?)(?:\?((?:[a-z0-9-._~!$&\'()*+,;=:/?@]|%[0-9A-F]{2})*))?(?:#((?:[a-z0-9-._~!$&\'()*+,;=:/?@]|%[0-9A-F]{2})*))?$/i';
    //const REGEX_URI = '((?<=\()[A-Za-z][A-Za-z0-9\+\.\-]*:([A-Za-z0-9\.\-_~:/\?#\[\]@!\$&\'\(\)\*\+,;=]|%[A-Fa-f0-9]{2})+(?=\)))|([A-Za-z][A-Za-z0-9\+\.\-]*:([A-Za-z0-9\.\-_~:/\?#\[\]@!\$&\'\(\)\*\+,;=]|%[A-Fa-f0-9]{2})+)';

    /**
     * Is base64 encoded data?
     * @see https://www.ietf.org/rfc/rfc2396.txt
     * @param string $data
     * @return bool
     */
    public static function isBase64(string $data): bool
    {
        return \base64_decode($data, true) !== false;
    }

    /**
     * Is URI string?
     * @param string $subject
     * @return bool
     */
    public static function isUri(?string $subject): bool
    {
        return filter_var($subject, FILTER_VALIDATE_URL) !== false;
        //return \preg_match(self::REGEX_URI, $subject) > 0;
    }
}
