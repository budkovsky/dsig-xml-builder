<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

trait SimpleContentTrait
{
    /** @var string */
    protected $simpleContent;

    public static function create(): self
    {
        return new static();
    }

    /**
     *
     * @return string|NULL
     */
    public function getSimpleContent(): ?string
    {
        return $this->simpleContent;
    }

    /**
     *
     * @param string $value
     */
    public function setSimpleContent(string $value): self
    {
        $this->simpleContent = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->simpleContent ?? '';
    }
}
