<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

/**
 * SignedInfo validator
 */
class SignedInfoValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SignedInfoType $entity */
        $this->processValidationStep(
            $entity->getCanonicalizationMethod() !== null,
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            $this->getName(),
            'CanonicalizationMethod'
        );
        CanonicalizationMethodValidator::create()->addObserver($this)->validate($entity->getCanonicalizationMethod());
        $this->processValidationStep(
            $entity->getSignatureMethod() !== null,
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            $this->getName(),
            'SignatureMethod'
        );
        SignatureMethodValidator::create()->addObserver($this)->validate($entity->getSignatureMethod());
        $this->processValidationStep(
            $entity->getReferences()->count() >= 1,
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            $this->getName(),
            'Reference'
        );
        $this->processValidationStep(
            $entity->getReferences()->count() > 0,
            ValidationMessage::REQUIRED_AT_LEAST_ONE_ELEMENT,
            $this->getName(),
            'Reference'
        );
        foreach ($entity->getReferences() as $reference) {
            ReferenceValidator::create()->addObserver($this)->validate($reference);
        }
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }
    }
}
