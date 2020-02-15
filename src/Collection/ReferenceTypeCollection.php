<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;

/**
 * Collection of ReferenceType objects
 */
class ReferenceTypeCollection extends CollectionAbstract
{
    /**
     * Adds ReferenceType object to the collection
     *
     * @param ReferenceType $reference
     * @return ReferenceTypeCollection
     */
    public function add(?ReferenceType $reference = null): ReferenceTypeCollection
    {
        if ($reference) {
            $this->collection[] = $reference;
        }

        return $this;
    }
}
