<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\Aid\Validator\Entity\ValidationResult;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\ValidationMessage;
use Budkovsky\DsigXmlBuilder\Exception\DsigXmlBuilderException;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Helper\RestrictionHelper;

/**
 * Validator for entity trait
 *
 * Designed to work with ValidatorAbstract
 */
trait ValidatorEntityTrait
{
    private function processValidationStep(
        bool $isValid,
        string $messageTemplate,
        string ...$messagePieces
    ): ValidatorAbstract {
        $this->getResult()->mergeValid(true);

        if (!$isValid) {
            $message = \sprintf($messageTemplate, ...$messagePieces);
            if (!$this->isSilentMode()) {
                throw new RestrictionException($message);
            }
            $this->getResult()->addMessage($message);
            $this->getResult()->setValid(false);
        }

        return $this;
    }

    private function validateIsNotEmpty(?string $value, string $childName): void
    {
        $this->processValidationStep(
            !empty($value),
            ValidationMessage::IS_EMPTY,
            $this->getName(),
            $childName
        );
    }

    private function validateIsBase64(?string $value, string $childName): void
    {
        $this->processValidationStep(
            RestrictionHelper::isBase64($value),
            ValidationMessage::NOT_BASE64,
            $this->getName(),
            $childName
        );
    }

    private function validateIsUri(?string $value, string $childName): void
    {
        $this->processValidationStep(
            RestrictionHelper::isUri($value),
            ValidationMessage::NOT_URI,
            $this->getName(),
            $childName
        );
    }

    private function validateIsLegalValue(?string $needle, array $haystack, $childName): void
    {
        $this->processValidationStep(
            \in_array($needle, $haystack),
            ValidationMessage::ILLEGAL_VALUE,
            $this->getName(),
            $childName,
            $needle
        );
    }

    private function validatePairRestriction(?string $value1, ?string $value2, string $childName1, $childName2): void
    {
        $this->processValidationStep(
            ($value1 && $value2) || (!$value1 && !$value2),
            ValidationMessage::PAIR_RESTRICTION_FAIL,
            $this->getName(),
            $childName1,
            $childName2
        );
    }

    private function validateObligatoryField(?string $value, string $childName): void
    {
        $this->processValidationStep(
            !empty($value),
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            $this->getName(),
            $childName
        );
    }

    private function validateAllowedOneChildOnly(bool $condition): void
    {
        $this->processValidationStep(
            $condition,
            ValidationMessage::ALLOWED_ONE_CHILD_ONLY,
            $this->getName()
        );
    }

    private function getAttributeNameForMessage(string $name): string
    {
        if (!Attribute::isValid($name)) {
            throw new DsigXmlBuilderException("Invalid attribute name: `{$name}`");
        }

        return "{$name}(attribute)";
    }

    private function validateAttributeNotEmpty(?string $value, string $attributeName): void
    {
        $this->validateIsNotEmpty($value, $this->getAttributeNameForMessage($attributeName));
    }

    private function validateAttributeValidUri(?string $value, string $attributeName): void
    {
        $this->validateIsUri($value, $this->getAttributeNameForMessage($attributeName));
    }

    private function validateAttributeLegal(?string $algorithm, array $haystack, string $attributeName): void
    {
        $this->validateIsLegalValue(
            $algorithm,
            $haystack,
            $this->getAttributeNameForMessage($attributeName),
            $algorithm
        );
    }

    abstract public function getName(): string;

    abstract protected function processValidation(DSigTypeInterface $entity): void;

    abstract public function getResult(): ValidationResult;

    abstract public function isSilentMode(): bool;

    abstract public function notifyObservers(): ValidatorAbstract;
}
