<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;

/**
 * SignatureProperty collection
 */
class SignaturePropertyCollection extends CollectionAbstract
{

    public function add(?SignaturePropertyType $signatureProerty = null): SignaturePropertyCollection
    {
        if ($signatureProerty) {
            $this->collection[] = $signatureProerty;
        }

        return $this;
    }
}
