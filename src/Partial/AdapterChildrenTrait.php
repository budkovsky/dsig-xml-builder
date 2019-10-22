<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;

trait AdapterChildrenTrait
{
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

    abstract protected function getNewElementFromEntity(DSigTypeInterface $entity): \DOMElement;

    abstract public function getDOMElement(): \DOMElement;

    /**
     * @return \Budkovsky\DsigXmlBuilder\Abstraction\ChildrenContainerInterface
     */
    abstract public function getEntity();
}
