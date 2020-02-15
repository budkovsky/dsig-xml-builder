<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\Xpath;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * Validator for TransformType entity
 */
class TransformValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\TransformType $entity */
        if ($entity->getChildren()) {
            foreach ($entity->getChildren() as $child) {
                if ($child instanceof Xpath) {
                    $this->validateIsNotEmpty($child, Tag::XPATH_ELEMENT);
                }
            }
        }
        $this->validateAttributeNotEmpty($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
        $this->validateAttributeValidUri($entity->getAlgorithmAttribute(), Attribute::ALGORITHM);
    }
}
