<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

/**
 * Validator for SignatureMethodType entity
 */
class SignatureMethodValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType $entity */
        $this->validateAttributeNotEmpty($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
        $this->validateAttributeValidUri($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
    }
}
