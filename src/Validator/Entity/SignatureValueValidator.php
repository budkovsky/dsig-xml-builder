<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

/**
 * Validator for SignatureValueType entity
 */
class SignatureValueValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SignatureValueType $entity */
        $this->validateIsNotEmpty($entity->getSimpleContent(), 'simpleContent');
        $this->validateIsBase64($entity->getSimpleContent(), 'simpleContent');
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute());
        }
    }
}
