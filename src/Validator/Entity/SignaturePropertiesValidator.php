<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

/**
 * Validator for SignaturePropertiesType entity
 */
class SignaturePropertiesValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType $entity */
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }

        $this->processValidationStep(
            $entity->getSignatureProperties()->count() > 0,
            ValidationMessage::NOT_SET.', at least one subelement of this type is required',
            $this->getName(),
            'SignatureProperty'
        );

        foreach ($entity->getSignatureProperties() as $signatureProperty) {
            SignaturePropertyValidator::create()->addObserver($this)->validate($signatureProperty);
        }
    }
}
