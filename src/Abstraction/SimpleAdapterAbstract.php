<?php
namespace Budkovsky\DsigXmlBuilder\Abstraction;

abstract class SimpleAdapterAbstract extends AdapterAbstract
{

    protected function getEntity(): SimpleContentInterface
    {
        return $this->entity;
    }

    public function generate(): AdapterInterface
    {
        $this->generateMainElement($this->getTagName(), $this->getEntity()->getSimpleContent());

        return $this;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SimpleContentInterface::class;
    }

    abstract protected function getTagName(): string;
}

