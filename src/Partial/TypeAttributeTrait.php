<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * Trait for entities contain `Type` attribute
 */
trait TypeAttributeTrait
{
    /** @var string */
    protected $typeAttribute;

    /**
     * Getter of type attribute
     *
     * @return string|NULL
     */
    public function getTypeAttribute(): ?string
    {
        return $this->typeAttribute;
    }

    /**
     * Setter for type attribute
     *
     * @param string $type
     * @return self
     */
    public function setTypeAttribute(string $type): self
    {
        $this->typeAttribute = $type;

        return $this;
    }
}
