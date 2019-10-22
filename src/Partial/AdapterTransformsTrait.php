<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

trait AdapterTransformsTrait
{
    protected function getTransformsElement(?TransformTypeCollection $collection): \DOMElement
    {
        if ($collection !== null && $collection->count() > 0) {

            $container = $this->getNewElement(Tag::TRANSFORMS_ELEMENT);
            foreach ($collection as $transform) {
                $container->appendChild(
                    $this->getNewElementFromEntity($transform)
                );
            }
        }

        return $container;
    }

    abstract protected function getNewElement(string $name, string $value = ''): \DOMElement;
}
