<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

/**
 * `URI` attribute trait
 */
trait UriAttributeTrait
{
    /** @var string */
    protected $uriAttribute;

    /**
     * @return string|NULL
     */
    public function getUriAttribute(): ?string
    {
        return $this->uriAttribute;
    }

    /**
     * @param string $uri
     * @return self
     */
    public function setUriAttribute(string $uri): self
    {
        $this->uriAttribute = $uri;

        return $this;
    }
}
