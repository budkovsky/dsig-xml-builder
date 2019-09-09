<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\TransformAdapter;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\Aid\Abstraction\EntityInterface;

trait AdapterTransformsTrait
{
    protected function getTransformsElement(?TransformTypeCollection $collection): \DOMElement
    {
        if ($collection !== null && $collection->count() > 0) {

            $container = $this->getNewElement(Tag::TRANSFORMS_ELEMENT);
            foreach ($collection as $transform) {
                $container->appendChild(
                    $this->getNewElementByAdapter($transform, new TransformAdapter())
                );
            }
        }

        return $container;
    }

    abstract protected function getNewElement(string $name, string $value = ''): \DOMElement;

    abstract protected function getNewElementByAdapter(EntityInterface $entity, AdapterInterface $adapter): \DOMElement;
}
