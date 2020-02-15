<?php
namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\EntityInterface;

/**
 * Digital signature entity type interface
 */
interface DSigTypeInterface extends EntityInterface
{
    /**
     * Getter of adapter assigned with entity
     * @return AdapterInterface|NULL
     */
    public function getAdapter(): ?AdapterInterface;

    /**
     * Setter for adapter assigned with entity
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter);
}
