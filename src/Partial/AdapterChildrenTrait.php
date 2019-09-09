<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

trait AdapterChildrenTrait
{
    use AnyAdapterTrait;

    protected function generateChildren(): self
    {
        $children = $this->getEntity()->getChildren();

        if ($children) {
            foreach ($children as $anyEntity) {
                $this->getDOMElement()->appendChild(
                    $this->getNewElementFromEntity($anyEntity)
                );
            }
        }

        return $this;
    }

    abstract protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement;

    abstract protected function getNewElementByAdapter(EntityInterface $entity, AdapterInterface $adapter): \DOMElement;

    abstract public function getDOMDocument(): \DOMDocument;

    abstract public function getDOMElement(): \DOMElement;

    /**
     * @return \Budkovsky\DsigXmlBuilder\Abstraction\ChildrenContainerInterface
     */
    abstract public function getEntity();
}
