<?php
namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\SPKISexp;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;

/**
 * Validator for SPKIDataType entity
 */
class SPKIDataValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\SPKIDataType $entity */

        $spkiSexpChildrenCounter = 0;

        if ($entity->getChildren()) {
            foreach ($entity->getChildren() as $child) {
                if ($child instanceof SPKISexp) {
                    $spkiSexpChildrenCounter++;
                    $this->validateIsNotEmpty($child, Tag::SPKI_SEXP_ELEMENT);
                    $this->validateIsBase64($child, Tag::SPKI_SEXP_ELEMENT);
                }
            }
        }

        $this->processValidationStep(
            $spkiSexpChildrenCounter > 0,
            ValidationMessage::REQUIRED_AT_LEAST_ONE_ELEMENT,
            $this->getName(),
            Tag::SPKI_SEXP_ELEMENT
        );
    }
}
