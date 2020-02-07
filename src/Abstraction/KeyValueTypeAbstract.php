<?php
namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\DsigXmlBuilder\Enum\KeyValueChoice;
use Budkovsky\DsigXmlBuilder\Exception\FactoryException;
use Budkovsky\Aid\Abstraction\AbstractFactoryInterface;

abstract class KeyValueTypeAbstract implements AbstractFactoryInterface
{


    public static function factory(string $type): KeyValueTypeAbstract
    {
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
