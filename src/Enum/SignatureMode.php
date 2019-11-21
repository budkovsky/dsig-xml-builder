<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

use Budkovsky\Aid\Abstraction\EnumAbstract;

class SignatureMode extends EnumAbstract
{
    const ENVELOPED = 'enveloped';
    const ENVELOPING = 'enveloping';
    const DETACHED = 'detached';

    public function getAll(): array
    {
        return [
            'ENVELOPED' => self::ENVELOPED,
            'ENVELOPING' => self::ENVELOPING,
            'DETACHED' => self::DETACHED
        ];
    }
}
