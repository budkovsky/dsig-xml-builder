<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Exception\AdapterException;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\XmlNs;

abstract class AdapterAbstract implements AdapterInterface
{
    /** @var string */
    protected $entityType;

    /** @var \DOMDocument */
    protected $document;

    /** @var EntityInterface */
    protected $entity;

    /** @var \Budkovsky\ExtendedDomElement\ExtendedDomElement */
    protected $element;

    /** @var string */
    protected $elementTag;

    /** @var string */
    protected $namespace = XmlNs::XML_DSIG_2000_09;

    protected $elementPrefix = 'ds:';

    public function __construct()
    {
        $this->setEntityType();
    }

    public static function create(): AdapterAbstract
    {
        return new static;
    }

    public function setDocument(\DOMDocument $document): AdapterInterface
    {
        $this->document = $document;

        return $this;
    }

    public function setEntity(EntityInterface $entity): AdapterInterface
    {
        if (!($entity instanceof $this->entityType)) {
            throw new AdapterException(\sprintf(
                '`%s` is invalid entity type for `%s`',
                \get_class($entity),
                static::class
            ));
        }
        $this->entity = $entity;

        return $this;
    }

    public function setNamespace(string $namespace): AdapterInterface
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setElementPrefix(string $prefix): AdapterInterface
    {
        $this->elementPrefix = $prefix;

        return $this;
    }

    public function getDOMDocument(): \DOMDocument
    {
        return $this->document;
    }

    public function getDOMElement(): \DOMElement
    {
        return $this->element;
    }

    protected function generateMainElement(string $name, string $value = ''): AdapterAbstract
    {
        $this->element = $this->getNewElement($name, $value);

        return $this;
    }

    protected function generateChild(string $name, string $value = ''): AdapterAbstract
    {
        $this->element->appendChild($this->getNewElement($name, $value));

        return $this;
    }

    protected function generateAttribute(string $name, $value):  AdapterAbstract
    {
        if ($value !== null) {
            $this->element->setAttribute($name, $value);
        }
        if ($value !== null && $name == Attribute::ID) {
            $this->element->setIdAttribute($name, true);
        }
        return $this;
    }

    protected function getNewElement(string $name, string $value = ''): \DOMElement
    {
        return !empty($this->namespace)
            ? $this->document->createElementNS($this->namespace, $this->elementPrefix.$name, $value)
            : $this->document->createElement($name, $value)
        ;
    }

    protected function getNewElementFromEntity(DSigTypeInterface $entity): \DOMElement
    {
        return $entity->getAdapter()
            ->setDocument($this->getDOMDocument())
            ->setEntity($entity)
            ->generate()
            ->getDOMElement()
        ;
    }

    abstract protected function getEntity();

    abstract protected function setEntityType(): void;
}
