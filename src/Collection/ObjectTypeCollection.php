<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;

/**
 * Collection of ObjectType objects
 */
class ObjectTypeCollection extends CollectionAbstract
{
    /**
     * Adds ObjectType to the collection
     *
     * @param ObjectType $object
     * @return ObjectTypeCollection
     */
    public function add(?ObjectType $object = null): ObjectTypeCollection
    {
        if ($object) {
            $this->collection[] = $object;
        }

        return $this;
    }
}
