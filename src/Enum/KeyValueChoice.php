<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;

/**
 * KeyValueChoice enumeration
 */
class KeyValueChoice extends EnumAbstract
{
    const DSA = 'DSAKeyValue';
    const RSA = 'RSAKeyValue';
    const ANY = 'ANY';

    /**
     * @inheritdoc
     */
    public static function getAll(): array
    {
        return [
            'DSA' => self::DSA,
            'RSA' => self::RSA,
            'ANY' => self::ANY
        ];
    }
}

