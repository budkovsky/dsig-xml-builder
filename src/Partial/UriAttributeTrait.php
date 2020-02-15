<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * Trait for entities contain `URI` attribute
 */
trait UriAttributeTrait
{
    /** @var string */
    protected $uriAttribute;

    /**
     * Getter of URI attribute
     *
     * @return string|NULL
     */
    public function getUriAttribute(): ?string
    {
        return $this->uriAttribute;
    }

    /**
     * Setter for URI attribute
     *
     * @param string $uri
     * @return self
     */
    public function setUriAttribute(string $uri): self
    {
        $this->uriAttribute = $uri;

        return $this;
    }
}
