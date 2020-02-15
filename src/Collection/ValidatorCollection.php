<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;

/**
 * Collection of Validator objects
 */
class ValidatorCollection extends CollectionAbstract
{

    /**
     * Adds validator object to the collection
     *
     * @param ValidatorAbstract $validator1
     * @return ValidatorCollection
     */
    public function add(?ValidatorAbstract $validator = null): ValidatorCollection
    {
        if ($validator) {
            $this->collection[] = $validator;
        }
    }
}
