<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

/**
 * Validator for DigestMethodType entity
 */
class DigestMethodValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(?DSigTypeInterface $entity = null): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\DigestMethodType $entity */
        //TODO digest method algortihm validation by enum
        $this->validateAttributeNotEmpty($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
        $this->validateAttributeValidUri($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
    }
}
