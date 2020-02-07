<?php
namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

class KeyValueValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {

        /** @var KeyValueType $entity */
        if ($entity->getAny() !== null) {
            $this->validateAnyEntity($entity);
        } elseif ($entity->getDsaKeyValue() !== null) {
            $this->validateDsa($entity);
        } elseif ($entity->getRsaKeyValue() !== null) {
            $this->validateRsa($entity);
        } else {
            $this->processValidationStep(false, ValidationMessage::IS_EMPTY, $this->getName(), 'entity');
        }
    }

    protected function validateAnyEntity(KeyValueType $keyValue): void
    {
        if ($keyValue->getDsaKeyValue() !== null || $keyValue->getRsaKeyValue() !== null) {
            $this->validateAllowedOneChildOnly(false);
        } else {
            //TODO validate any entity
            $this->result->mergeValid(true);
        }
    }

    protected function validateRsa(KeyValueType $keyValue): void
    {
        if ($keyValue->getAny() !== null || $keyValue->getDsaKeyValue() !== null) {
            $this->validateAllowedOneChildOnly(false);
        } else {
            RSAKeyValueValidator::create()->addObserver($this)->validate($keyValue->getRsaKeyValue());
        }
    }

    protected function validateDsa(KeyValueType $keyValue): void
    {
        if ($keyValue->getAny() !== null || $keyValue->getRsaKeyValue() !== null) {
            $this->validateAllowedOneChildOnly(false);
        } else {
            DSAKeyValueValidator::create()->addObserver($this)->validate($keyValue->getDsaKeyValue());
        }
    }
}
