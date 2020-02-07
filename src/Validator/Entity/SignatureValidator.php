<?php
namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

class SignatureValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SignatureType $entity */

        $this->processValidationStep(
            $entity->getSignedInfo() !== null,
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            'SignedInfo'
        );
        SignedInfoValidator::create()->addObserver($this)->validate($entity->getSignedInfo());
        $this->processValidationStep(
            $entity->getSignatureValue() !== null,
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            'SignatureValue'
        );
        SignatureValueValidator::create()->addObserver($this)->validate($entity->getSignatureValue());
        if ($entity->getKeyInfo()) {
            KeyInfoValidator::create()->addObserver($this)->validate($entity->getKeyInfo());
        }
        //TODO ObjectType validation skeleton
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }
    }
}
