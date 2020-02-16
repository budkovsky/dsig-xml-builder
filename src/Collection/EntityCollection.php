<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Abstraction\CollectionAbstract;

/**
 * Typed indexed collection of entities
 */
class EntityCollection extends CollectionAbstract
{
    /**
     * @param EntityInterface $entity
     * @return EntityCollection
     */
    public function add(?EntityInterface $entity = null): EntityCollection
    {
        if ($entity) {
            $this->collection[] = $entity;
        }

        return $this;
    }
}
