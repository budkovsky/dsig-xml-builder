<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

/**
 * Reference validator
 */
class ReferenceValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\ReferenceType $entity */
        if($entity->getTransforms()) {
            foreach ($entity->getTransforms() as $transform) {
                TransformValidator::create('Transforms')->addObserver($this)->validate($transform);
            }
        }
        DigestMethodValidator::create('DigestMethod')->addObserver($this)->validate($entity->getDigestMethod());
        $this->validateDigestValue($entity->getDigestValue(), 'DigestValue');
        if ($entity->getIdAttribute() !== null) {
            $this->validateAttributeNotEmpty($entity->getIdAttribute(), Attribute::ID);
        }
        if ($entity->getUriAttribute() !== null) {
            $this->validateAttributeValidUri($entity->getUriAttribute(), Attribute::URI);
        }
        if ($entity->getTypeAttribute() !== null) {
            $this->validateAttributeValidUri($entity->getTypeAttribute(), Attribute::TYPE);
        }
    }

    protected function validateDigestValue(?string $value, string $name): void
    {
        $this->validateIsNotEmpty($value, $name);
        $this->validateIsBase64($value, $name);
    }
}
