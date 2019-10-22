<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;

trait AdapterReferencesTrait
{
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

    /** @see \Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract::getDOMElement() */
    abstract public function getDOMElement(): \DOMElement;
}
