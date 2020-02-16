<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Exception\AdapterException;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\XmlNs;
use DOMDocument;
use DOMElement;

/**
 * Abstract adapter
 */
abstract class AdapterAbstract implements AdapterInterface
{
    /** @var string */
    protected $entityType;

    /** @var DOMDocument */
    protected $document;

    /** @var EntityInterface */
    protected $entity;

    /** @var DOMElement */
    protected $element;

    /** @var string */
    protected $elementTag;

    /** @var string */
    protected $namespace = XmlNs::XML_DSIG_2000_09;

    protected $elementPrefix = 'ds:';

    /**
     * Adapter's constructor
     */
    public function __construct()
    {
        $this->setEntityType();
    }

    /**
     * Adapter's static factory
     *
     * @return AdapterAbstract
     */
    public static function create(): AdapterAbstract
    {
        return new static;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function setDocument(DOMDocument $document): AdapterInterface
    {
        $this->document = $document;

        return $this;
    }

    /**
     *
     * {@inheritdoc}
     */
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

    /**
     *
     * {@inheritdoc}
     */
    public function setNamespace(string $namespace): AdapterInterface
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function setElementPrefix(string $prefix): AdapterInterface
    {
        $this->elementPrefix = $prefix;

        return $this;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getDOMDocument(): DOMDocument
    {
        return $this->document;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getDOMElement(): DOMElement
    {
        return $this->element;
    }

    /**
     * Generate DOMElement according to entity
     *
     * @param string $name
     * @param string $value
     * @return AdapterAbstract
     */
    protected function generateMainElement(string $name, string $value = ''): AdapterAbstract
    {
        $this->element = $this->getNewElement($name, $value);

        return $this;
    }

    /**
     * Generate child element
     *
     * @param string $name
     * @param string $value
     * @return AdapterAbstract
     */
    protected function generateChild(string $name, string $value = ''): AdapterAbstract
    {
        $this->element->appendChild($this->getNewElement($name, $value));

        return $this;
    }

    /**
     * Generate attribute of main element
     *
     * @param string $name
     * @param string|integer $value
     * @return AdapterAbstract
     */
    protected function generateAttribute(string $name, $value): AdapterAbstract
    {
        if ($value !== null) {
            $this->element->setAttribute($name, $value);
        }
        if ($value !== null && $name == Attribute::ID) {
            $this->element->setIdAttribute($name, true);
        }
        return $this;
    }

    /**
     * Create and return new DOMElement but not append to main element
     *
     * @param string $name
     * @param string $value
     * @return DOMElement
     */
    protected function getNewElement(string $name, string $value = ''): DOMElement
    {
        return !empty($this->namespace)
            ? $this->document->createElementNS($this->namespace, $this->elementPrefix.$name, $value)
            : $this->document->createElement($name, $value)
        ;
    }

    /**
     * Create and return new DOMElement from entity but not append to main element
     *
     * @param DSigTypeInterface $entity
     * @return DOMElement
     */
    protected function getNewElementFromEntity(DSigTypeInterface $entity): DOMElement
    {
        return $entity->getAdapter()
            ->setDocument($this->getDOMDocument())
            ->setEntity($entity)
            ->generate()
            ->getDOMElement()
        ;
    }

    /**
     * Entity getter
     */
    abstract protected function getEntity();

    /**
     * Entity type(class) setter
     */
    abstract protected function setEntityType(): void;
}
