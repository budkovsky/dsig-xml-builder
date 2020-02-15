<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;

/**
 * Trait for adapter assigned to entity contains reference collection
 */
trait AdapterReferencesTrait
{
    /**
     * Generates reference sub-elements
     *
     * @param ReferenceTypeCollection $collection
     * @return self
     */
    protected function generateReferenceElements(?ReferenceTypeCollection $collection): self
    {
        if ($collection !== null) {
            foreach ($collection as $entity) {
                $this->getDOMElement()->appendChild(
                    $this->getNewElementFromEntity($entity)
                );
            }
        }

        return $this;
    }

    /**
     * Returns main entity assigned with adapter
     *
     * @see \Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract::getDOMElement()
     * @return \DOMElement
     */
    abstract public function getDOMElement(): \DOMElement;
}
