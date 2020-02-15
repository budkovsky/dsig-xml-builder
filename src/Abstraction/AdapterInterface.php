<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\Aid\Abstraction\EntityInterface;

/**
 * Entity to DOMElement adapter interface
 */
interface AdapterInterface extends StaticFactoryInterface, DOMDocumentGetter, DOMElementGetter
{
    /**
     * \DOMDocument setter
     * @param \DOMDocument $document
     * @return AdapterInterface
     */
    public function setDocument(\DOMDocument $document): AdapterInterface;
    
    /**
     * Entity setter
     * @param EntityInterface $entity
     * @return AdapterInterface
     */
    public function setEntity(EntityInterface $entity): AdapterInterface;
    
    /**
     * XML element's namespace setter
     * @param string $namespace
     * @return AdapterInterface
     */
    public function setNamespace(string $namespace): AdapterInterface;
    
    /**
     * XML element's name prefix setter
     * @param string $prefix
     * @return AdapterInterface
     */
    public function setElementPrefix(string $prefix): AdapterInterface;
    
    /**
     * Generate DOMElement from Entity
     * @return AdapterInterface
     */
    public function generate(): AdapterInterface;
}
