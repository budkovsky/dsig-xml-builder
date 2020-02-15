<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

/**
 * Validator for RetrievalMethodType entity
 */
class RetrievalMethodValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
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

    /**
     * Validates TransformType entities collection
     *
     * @param TransformTypeCollection $transformCollection
     */
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
