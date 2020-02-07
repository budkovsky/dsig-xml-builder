<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

class RetrievalMethodValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType $entity */
        $this->validateAttributeNotEmpty($entity->getUriAttribute(), Attribute::URI);
        $this->validateAttributeValidUri($entity->getUriAttribute(), Attribute::URI);
        if ($entity->getTypeAttribute() !== null) {
            $this->validateAttributeValidUri($entity->getTypeAttribute(), Attribute::TYPE);
        }
        $this->validateTransforms($entity->getTransforms());
    }

    protected function validateTransforms(?TransformTypeCollection $transformCollection): void
    {
        foreach ($transformCollection as $transform) {
            TransformValidator::create('Transforms')
                ->addObserver($this)
                ->validate($transform)
            ;
        }
    }
}
