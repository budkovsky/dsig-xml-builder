<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;

/**
 * Collection of SignaturePropertyType objects
 */
class SignaturePropertyCollection extends CollectionAbstract
{

    /**
     * Adds SignaturePropertyType object to the collection
     *
     * @param SignaturePropertyType $signatureProperty
     * @return SignaturePropertyCollection
     */
    public function add(?SignaturePropertyType $signatureProerty = null): SignaturePropertyCollection
    {
        if ($signatureProerty) {
            $this->collection[] = $signatureProerty;
        }

        return $this;
    }
}
