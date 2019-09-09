<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;

/**
 * ObjectTypeCollection
 */
class ObjectTypeCollection extends CollectionAbstract
{
    /**
     * {@inheritDoc}
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
