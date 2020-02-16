<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\DsigXmlBuilder\Enum\KeyValueChoice;
use Budkovsky\DsigXmlBuilder\Exception\FactoryException;
use Budkovsky\Aid\Abstraction\AbstractFactoryInterface;

/**
 * @TODO to remove or not?
 */
abstract class KeyValueTypeAbstract implements AbstractFactoryInterface
{
    /**
     * Static factory for concrete KeyValueType classes
     *
     * @SuppressWarnings(PHPMD.MissingImport)
     *
     * @param string $type
     * @throws FactoryException
     * @return KeyValueTypeAbstract
     */
    public static function factory(string $type): KeyValueTypeAbstract
    {
        //TODO finish implementation
        if (!KeyValueChoice::isValid($type)) {
            throw new FactoryException(
                "`$type` is not valid argument for KeyValueType factory"
            );
        }
        $className = null;
        switch ($type) {
            case KeyValueChoice::DSA:
                break;
            case KeyValueChoice::RSA:
                break;
            case KeyValueChoice::ANY:
                break;
        }

        return new $className;
    }
}
