<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

/**
 * Entity validator
 */
interface EntityValidator
{
    /**
     * Returns validation result
     * @return bool
     */
    public static function isValid(): bool;
}
