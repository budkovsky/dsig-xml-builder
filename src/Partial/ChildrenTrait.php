<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;

/**
 * Trait for entities contain children entities with open structure
 *
 */
trait ChildrenTrait
{
    /** @var EntityCollection */
    protected $children;

    /**
     * Getter of children entity collection
     *
     * @return EntityCollection|NULL
     */
    public function getChildren(): ?EntityCollection
    {
        return $this->children;
    }

    /**
     * Setter for children entity collection
     *
     * @param EntityCollection $entities
     * @return self
     */
    public function setChildren(EntityCollection $entities): self
    {
        $this->children = $entities;

        return $this;
    }

    /**
     * Adds entity to thec children collection
     *
     * @param EntityInterface $entity
     * @return self
     */
    public function addChild(EntityInterface $entity): self
    {
        if (!$this->children) {
            $this->children = new EntityCollection();
        }
        $this->children->add($entity);

        return $this;
    }
}
