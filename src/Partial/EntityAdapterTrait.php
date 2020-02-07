<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

trait EntityAdapterTrait
{
    /** @var AdapterInterface */
    protected $adapter;

    public function setAdapter(AdapterInterface $adapter): self
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->adapter ?? $this->adapter = $this->getDefaultAdapter();
    }

    abstract protected function getDefaultAdapter(): AdapterInterface;
}
