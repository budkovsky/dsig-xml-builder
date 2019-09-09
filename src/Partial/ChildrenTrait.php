<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Collection\EntityCollection;

/**
 * ChildrenTrait
 * Extension for entities based on xml complex types with <any> elements in schema
 */
trait ChildrenTrait
{
    /** @var EntityCollection */
    protected $children;

    /**
     * @return EntityCollection|NULL
     */
    public function getChildren(): ?EntityCollection
    {
        return $this->children;
    }

    /**
     * @param EntityCollection $entities
     * @return self
     */
    public function setChildren(EntityCollection $entities): self
    {
        $this->children = $entities;

        return $this;
    }

    /**
     * @param EntityInterface $entity
     * @return self
     */
    public function addChild(EntityInterface $entity): self
    {
        if(!$this->children) {
            $this->children = new EntityCollection();
        }
        $this->children->add($entity);

        return $this;
    }
}
