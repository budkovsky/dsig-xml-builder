<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\Aid\Collection\StringNamedCollection;
use Budkovsky\OpenSslWrapper\Keystore;

class XmlSec
{
    public static function saveCerts(Keystore $keystore, string $dir = '/tmp'): StringNamedCollection
    {
        $collection = new StringNamedCollection();
    }

}
