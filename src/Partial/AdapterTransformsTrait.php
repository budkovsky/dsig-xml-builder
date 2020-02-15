<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * Trait for adapter assigned to entity contains transform collection
 */
trait AdapterTransformsTrait
{
    /**
     * Creates and returns `Transforms` DOM element
     * @param TransformTypeCollection $collection
     * @return \DOMElement
     */
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

    /**
     * Creates and returns new DOM element
     *
     * @param string $name
     * @param string $value
     * @return \DOMElement
     */
    abstract protected function getNewElement(string $name, string $value = ''): \DOMElement;
}
