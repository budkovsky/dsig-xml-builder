<?php
namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;

/**
 * Enumerations of attributes for XML DSig types
 */
class Attribute extends EnumAbstract
{
    const ID = 'Id';
    const ALGORITHM = 'Algorithm';
    const TYPE = 'Type';
    const URI = 'URI';
    const TARGET = 'Target';
    const MIME_TYPE = 'MimeType';
    const ENCODING = 'Encoding';

    /**
     * {@inheritdoc}
     */
    public static function getAll(): array
    {
        return [
            'ID' => self::ID,
            'ALGORITHM' => self::ALGORITHM,
            'TYPE' => self::TYPE,
            'URI' => self::URI,
            'TARGET' => self::TARGET,
            'MIME_TYPE' => self::MIME_TYPE,
            'ENCODING' => self::ENCODING
        ];
    }
}
