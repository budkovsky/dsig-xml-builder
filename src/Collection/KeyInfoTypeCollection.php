<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;

class KeyInfoTypeCollection extends CollectionAbstract implements StaticFactoryInterface
{
    public function add(?KeyInfoType $keyInfo = null): KeyInfoTypeCollection
    {
        if ($keyInfo) {
            $this->collection[] = $keyInfo;
        }

        return $this;
    }
}

