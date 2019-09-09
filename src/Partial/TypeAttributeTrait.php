<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * `Type` attribute trait
 */
trait TypeAttributeTrait
{
    /** @var string */
    protected $typeAttribute;

    /**
     * @return string|NULL
     */
    public function getTypeAttribute(): ?string
    {
        return $this->typeAttribute;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setTypeAttribute(string $type): self
    {
        $this->typeAttribute = $type;

        return $this;
    }
}
