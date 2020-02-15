<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * Trair for entities with id attribute
 */
trait IdAttributeTrait
{
    /** @var string */
    protected $idAttribute;

    /**
     * Getter of id attribute
     *
     * @return string|NULL
     */
    public function getIdAttribute(): ?string
    {
        return $this->idAttribute;
    }

    /**
     * Setter for id attribute
     *
     * @param string $id
     * @return self
     */
    public function setIdAttribute(string $id): self
    {
        $this->idAttribute = $id;

        return $this;
    }
}
