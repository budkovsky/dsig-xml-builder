<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionIndexedAbstract;
use Budkovsky\Aid\Abstraction\EntityInterface;

/**
 * Typed indexed collection of entities
 */
class EntityCollection extends CollectionIndexedAbstract
{
    /**
     * @param EntityInterface $entity
     * @return EntityCollection
     */
    public function add(?string $index = null, ?EntityInterface $entity = null): EntityCollection
    {
        if ($index && $entity) {
            $this->collection[$index] = $entity;
        }

        return $this;
    }

    /**
     * Getter of collection's item
     *
     * @param string $index
     * @return EntityInterface
     */
    public function get(string $index): EntityInterface
    {
        return $this->collection[$index];
    }
}
