<?php
namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\EntityInterface;

interface DSigTypeInterface extends EntityInterface
{
    public function getAdapter(): ?AdapterInterface;

    public function setAdapter(AdapterInterface $adapter);
}
