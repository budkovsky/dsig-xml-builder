<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ReferenceAdapter;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

trait AdapterReferencesTrait
{
    protected function generateReferenceElements(?ReferenceTypeCollection $collection): self
    {
        if ($collection !== null) {
            foreach ($collection as $entity) {
                $this->getDOMElement()->appendChild(
                    $this->getNewElementByAdapter($entity, new ReferenceAdapter())
                    );
            }
        }

        return $this;
    }

    /** @see AdapterAbstract::getDOMElement() */
    abstract public function getDOMElement(): \DOMElement;

    /** @see AdapterAbstract::getNewElementByAdapter() */
    abstract protected function getNewElementByAdapter(EntityInterface $entity, AdapterInterface $adapter): \DOMElement;
}
