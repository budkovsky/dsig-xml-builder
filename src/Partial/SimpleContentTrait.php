<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * Trait for entities are model of simpleContent XML element
 */
trait SimpleContentTrait
{
    /** @var string */
    protected $simpleContent;

    /**
     * simpleContent entity static factory
     *
     * @return self
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * Getter of entity content
     *
     * @return string|NULL
     */
    public function getSimpleContent(): ?string
    {
        return $this->simpleContent;
    }

    /**
     * Setter for entity content
     *
     * @param string $value
     */
    public function setSimpleContent(string $value): self
    {
        $this->simpleContent = $value;

        return $this;
    }

    /**
     * Casts object to a string
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->simpleContent ?? '';
    }
}
