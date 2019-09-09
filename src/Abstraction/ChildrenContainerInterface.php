<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;
use Budkovsky\Aid\Abstraction\EntityInterface;

interface ChildrenContainerInterface extends EntityInterface
{
    public function getChildren(): EntityCollection;
}

