<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;

/**
 * ReferenceTypeCollection class
 */
class ReferenceTypeCollection extends CollectionAbstract
{
    /**
     * {@inheritDoc}
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
