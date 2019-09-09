<?php
namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

class ObjectValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\ObjectType $entity */
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }
        if ($entity->getMimeType() !== null) {
            $this->validateIsNotEmpty($entity->getMimeType(), 'MimeType(Attribute)');
        }
        if ($entity->getEncoding() !== null) {
            $this->validateIsUri($entity->getEncoding(), 'Encoding(Attribute)');
        }
    }
}
