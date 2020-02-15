<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

/**
 * Abstraction for simple content entity's adapter
 */
abstract class SimpleAdapterAbstract extends AdapterAbstract
{
    /**
     * Returns simple entity
     * {@inheritDoc}
     */
    protected function getEntity(): SimpleContentInterface
    {
        return $this->entity;
    }

    /**
     * Generate DOMElement from simple entity
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement($this->getTagName(), $this->getEntity()->getSimpleContent());

        return $this;
    }

    /**
     * Entity type setter
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = SimpleContentInterface::class;
    }

    /**
     * Returns tag name for DOMElement created from entity
     * @return string
     */
    abstract protected function getTagName(): string;
}
