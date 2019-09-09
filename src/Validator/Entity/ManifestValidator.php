<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

class ManifestValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\ManifestType $entity */
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }
        if ($entity->getReferences() === null || $entity->getReferences()->count() === 0) {
            $this->validateObligatoryField(null, 'Reference');
        }
        else {
            foreach ($entity->getReferences() as $reference) {
                ReferenceValidator::create()->addObserver($this)->validate($reference);
            }
        }
    }
}
