<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

/**
 * Validator for PGPDataType entity
 */
class PGPDataValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\PGPDataType $entity */
        $this->processValidationStep(
            $entity->getPgpKeyId() || $entity->getPgpKeyPacket(),
            ValidationMessage::INVALID_STRUCTURE . ', at least one of `PGPKeyId` or `PGPKeyPacket` must exist',
            $this->getName()
        );
        if ($entity->getPgpKeyId() !== null) {
            $this->validateIsBase64($entity->getPgpKeyId(), 'PGPKeyID');
        }
        if ($entity->getPgpKeyPacket() !== null) {
            $this->validateIsBase64($entity->getPgpKeyPacket(), 'PGPKeyPacket');
        }
    }
}
