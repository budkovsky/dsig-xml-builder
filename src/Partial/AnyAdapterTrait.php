<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * @property AdapterInterface $anyAdapter
 */
trait AnyAdapterTrait
{
    /** @var AdapterInterface */
    protected static $anyAdapter;

    public static function setAnyAdapter(AdapterInterface $adapter): void
    {
        static::$anyAdapter = $adapter;
    }

    public static function getAnyAdapter(): ?AdapterInterface
    {
        return static::$anyAdapter;
    }
}
