<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

/**
 * Validator for X509IssuerSerial entity
 */
class X509IssuerSerialValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType $entity */
        $this->validateIsNotEmpty($entity->getX509IssuerName(), Tag::X509_ISSUER_NAME_ELEMENT);
        $this->processValidationStep(
            $entity->getX509SerialNumber() !== null,
            ValidationMessage::NOT_SET,
            $this->getName(),
            Tag::X509_SERIAL_NUMBER_ELEMENT
        );
    }
}
