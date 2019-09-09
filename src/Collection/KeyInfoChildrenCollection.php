<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;

class KeyInfoChildrenCollection extends CollectionAbstract
{
    public function add(?KeyInfoChildInterface $child = null): KeyInfoChildrenCollection
    {
        if ($child) {
            $this->collection[] = $child;
        }

        return $this;
    }
}
