<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\Aid\Abstraction\EntityInterface;

interface AdapterInterface extends StaticFactoryInterface, DOMDocumentGetter, DOMElementGetter
{
    public function setDocument(\DOMDocument $document): AdapterInterface;

    public function setEntity(EntityInterface $entity): AdapterInterface;

    public function setNamespace(string $namespace): AdapterInterface;

    public function setElementPrefix(string $prefix): AdapterInterface;

    public function generate(): AdapterInterface;
}
