<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * Trait for entites contain adapter property
 */
trait EntityAdapterTrait
{
    /** @var AdapterInterface */
    protected $adapter;

    /**
     * Setter for entity adapter
     *
     * @param AdapterInterface $adapter
     * @return self
     */
    public function setAdapter(AdapterInterface $adapter): self
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Getter of entity adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter ?? $this->adapter = $this->getDefaultAdapter();
    }

    /**
     * Returns default adapter for the entity
     *
     * @return AdapterInterface
     */
    abstract protected function getDefaultAdapter(): AdapterInterface;
}
