<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;

/**
 * Trait for adapter assigned to entity with children entities
 */
trait AdapterChildrenTrait
{
    /**
     * Generates DOM sub-elements from children entities
     *
     * @return self
     */
    protected function generateChildren(): self
    {
        $children = $this->getEntity()->getChildren();

        if ($children) {
            foreach ($children as $childEntity) {
                $this->getDOMElement()->appendChild(
                    $this->getNewElementFromEntity($childEntity)
                );
            }
        }

        return $this;
    }

    /**
     * Creates and returns DOMElement from entity
     *
     * @param DSigTypeInterface $entity
     * @return \DOMElement
     */
    abstract protected function getNewElementFromEntity(DSigTypeInterface $entity): \DOMElement;

    /**
     * Returns DOMElement generated from entity assigned with adapter
     *
     * @return \DOMElement
     */
    abstract public function getDOMElement(): \DOMElement;

    /**
     * Returns entity assigned with adapter
     *
     * @see \Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract::getDOMElement()
     * @return \Budkovsky\DsigXmlBuilder\Abstraction\ChildrenContainerInterface
     */
    abstract public function getEntity();
}
