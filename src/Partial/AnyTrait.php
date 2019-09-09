<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Abstraction\EntityInterface;

trait AnyTrait
{
    /** @var  EntityInterface */
    protected $any;

    /**
     * @return EntityInterface|NULL
     */
    public function getAny(): ?EntityInterface
    {
        return $this->any;
    }

    /**
     * @param EntityInterface $anyEntity
     * @return self
     */
    public function setAny(EntityInterface $anyEntity): self
    {
        $this->any = $anyEntity;

        return $this;
    }
}
