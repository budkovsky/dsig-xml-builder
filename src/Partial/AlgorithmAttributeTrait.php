<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

trait AlgorithmAttributeTrait
{
    /** @var string */
    protected $algorithmAttribute;

    /**
     * @return string|NULL
     */
    public function getAlgorithmAttribute(): ?string
    {
        return $this->algorithmAttribute;
    }

    /**
     * @param string $algorithm
     * @return self
     */
    public function setAlgorithmAttribute(string $algorithm): self
    {
        $this->algorithmAttribute = $algorithm;

        return $this;
    }
}
