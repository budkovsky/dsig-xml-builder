<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * `Id` attribute trait
 */
trait IdAttributeTrait
{
    /** @var string */
    protected $idAttribute;

    /**
     * @return string|NULL
     */
    public function getIdAttribute(): ?string
    {
        return $this->idAttribute;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setIdAttribute(string $id): self
    {
        $this->idAttribute = $id;

        return $this;
    }
}
