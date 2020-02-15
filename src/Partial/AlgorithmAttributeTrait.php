<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * Trait for entities with `Algorithm` attribute
 */
trait AlgorithmAttributeTrait
{
    /** @var string */
    protected $algorithmAttribute;

    /**
     * Getter of algorithm attribute
     *
     * @return string|NULL
     */
    public function getAlgorithmAttribute(): ?string
    {
        return $this->algorithmAttribute;
    }

    /**
     * Setter for algorithm attribute
     *
     * @param string $algorithm
     * @return self
     */
    public function setAlgorithmAttribute(string $algorithm): self
    {
        $this->algorithmAttribute = $algorithm;

        return $this;
    }
}
