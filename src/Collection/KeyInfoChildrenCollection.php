<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;

/**
 * Collection of KeyInfo children
 */
class KeyInfoChildrenCollection extends CollectionAbstract
{
    /**
     * Adds KeyInfo children to the collection
     *
     * @param KeyInfoChildInterface|NULL $child
     * @return KeyInfoChildrenCollection
     */
    public function add(?KeyInfoChildInterface $child = null): KeyInfoChildrenCollection
    {
        if ($child) {
            $this->collection[] = $child;
        }

        return $this;
    }
}
