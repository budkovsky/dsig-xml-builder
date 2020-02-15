<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

/**
 * Validator for RSAKeyValueType entity
 */
class RSAKeyValueValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType $entity */
        $this->validateRSAKeyValueChild('Modulus', $entity->getModulus());
        $this->validateRSAKeyValueChild('Exponent', $entity->getExponent());
    }

    /**
     * Validates children entities
     *
     * @param string $name
     * @param string $value
     */
    protected function validateRSAKeyValueChild(string $name, ?string $value): void
    {
        $this->validateIsNotEmpty($value, $name);
        $this->validateIsBase64($value, $name);
    }
}
