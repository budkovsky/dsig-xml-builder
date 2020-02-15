<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

/**
 * Collection of TransformType objects
 */
class TransformTypeCollection extends CollectionAbstract
{
    /**
     * Adds TransformType object to the collection
     *
     * @param TransformType $transform
     * @return TransformTypeCollection
     */
    public function add(?TransformType $transform = null): TransformTypeCollection
    {
        if ($transform) {
            $this->collection[] = $transform;
        }

        return $this;
    }
}
