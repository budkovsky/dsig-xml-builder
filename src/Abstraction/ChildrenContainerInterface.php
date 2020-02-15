<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Abstraction\EntityInterface;

/**
 * Interface of entity with collection of children entities
 */
interface ChildrenContainerInterface extends EntityInterface
{
    /**
     * Returns children entities collection
     * @return EntityCollection
     */
    public function getChildren(): EntityCollection;
}
