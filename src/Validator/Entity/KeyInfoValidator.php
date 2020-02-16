<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\KeyName;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\MgmtData;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

/**
 * Validator for KeyInfo entity
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class KeyInfoValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\KeyInfoType $entity */
        $this->processValidationStep(
            $entity->getChildren() !== null && $entity->getChildren()->count() > 0,
            ValidationMessage::IS_EMPTY,
            $this->getName(),
            Tag::KEY_INFO_ELEMENT
        );

        if ($entity->getChildren()) {
            foreach ($entity->getChildren() as $child) {
                /** @var \Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface $child */
                $this->validateKeyInfoChild($child);
            }
        }
    }

    /**
     * Validates KeyInfo child entity
     *
     * @param EntityInterface $child
     */
    protected function validateKeyInfoChild(EntityInterface $child): void
    {
        switch (true) {
            case $child instanceof KeyName:
                $this->validateIsNotEmpty($child->__toString(), Tag::KEY_NAME_ELEMENT);
                break;

            case $child instanceof KeyValueType:
                KeyValueValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof RetrievalMethodType:
                RetrievalMethodValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof X509DataType:
                X509DataValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof PGPDataType:
                PGPDataValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof SPKIDataType:
                SPKIDataValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof MgmtData:
                $this->validateIsNotEmpty($child->__toString(), Tag::MGMT_DATA_ELEMENT);
                break;
        }
    }
}
