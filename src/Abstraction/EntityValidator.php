<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

/**
 * Entity validator
 */
interface EntityValidator
{
    public static function isValid(): bool;
}

