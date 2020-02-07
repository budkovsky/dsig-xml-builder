<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

class ValidationMessage
{
    private const PREFIX = '`%s`: `%s` ';

    const NOT_SET = self::PREFIX . 'not set';
    const IS_EMPTY = self::PREFIX . 'is empty';
    const NOT_BASE64 = self::PREFIX . 'is not valid base64 string';
    const NOT_URI = self::PREFIX . 'is not valid URI';
    const ILLEGAL_VALUE = self::PREFIX . 'illegal value `%s`';
    const PAIR_RESTRICTION_FAIL = self::PREFIX . 'and `%s` elements must exist or not exist together';
    const OBLIGATORY_NOT_SET_OR_EMPTY = self::NOT_SET . ' or empty, but is obligatory';
    const ALLOWED_ONE_CHILD_ONLY = '`%s`: allowed one child only';
    const INVALID_STRUCTURE = '`%s`: Invalid structure';
    const ANY_CHILD_NOT_EXIST = '`%s`: any child element does not exist';
    const REQUIRED_AT_LEAST_ONE_ELEMENT = '`%s`: at least one `%s` element is required';
}
