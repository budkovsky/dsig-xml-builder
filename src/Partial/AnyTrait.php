<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Abstraction\EntityInterface;

/**
 * Trait for entities contain `any` entity
 */
trait AnyTrait
{
    /** @var  EntityInterface */
    protected $any;

    /**
     * Getter of `any` entity
     *
     * @return EntityInterface|NULL
     */
    public function getAny(): ?EntityInterface
    {
        return $this->any;
    }

    /**
     * Setter for `any` entity
     *
     * @param EntityInterface $anyEntity
     * @return self
     */
    public function setAny(EntityInterface $anyEntity): self
    {
        $this->any = $anyEntity;

        return $this;
    }
}
