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
use Budkovsky\DsigXmlBuilder\Helper\Restriction;

/**
 * Trait for entity validators
 *
 * Designed to work with ValidatorAbstract children types
 */
trait ValidatorEntityTrait
{
    /**
     * Processing single validation step
     *
     * @param bool $isValid
     * @param string $messageTemplate
     * @param string ...$messagePieces
     * @throws RestrictionException
     * @return ValidatorAbstract
     */
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

    /**
     * Validate is child not empty
     *
     * @param string $value
     * @param string $childName
     */
    private function validateIsNotEmpty(?string $value, string $childName): void
    {
        $this->processValidationStep(
            !empty($value),
            ValidationMessage::IS_EMPTY,
            $this->getName(),
            $childName
        );
    }

    /**
     * Validate is child base64 encoded string
     *
     * @param string $value
     * @param string $childName
     */
    private function validateIsBase64(?string $value, string $childName): void
    {
        $this->processValidationStep(
            Restriction::isBase64($value),
            ValidationMessage::NOT_BASE64,
            $this->getName(),
            $childName
        );
    }

    /**
     * Validate is child proper URI
     * @param string $value
     * @param string $childName
     */
    private function validateIsUri(?string $value, string $childName): void
    {
        $this->processValidationStep(
            Restriction::isUri($value),
            ValidationMessage::NOT_URI,
            $this->getName(),
            $childName
        );
    }

    /**
     * Validate has child legal value
     *
     * @param string $needle
     * @param array $haystack
     * @param string $childName
     */
    private function validateIsLegalValue(?string $needle, array $haystack, string $childName): void
    {
        $this->processValidationStep(
            \in_array($needle, $haystack),
            ValidationMessage::ILLEGAL_VALUE,
            $this->getName(),
            $childName,
            $needle
        );
    }

    /**
     * Validate is pair of children empty or not empty(both)
     *
     * @param string $value1
     * @param string $value2
     * @param string $childName1
     * @param string $childName2
     */
    private function validatePairRestriction(?string $value1, ?string $value2, string $childName1, string $childName2): void
    {
        $this->processValidationStep(
            ($value1 && $value2) || (!$value1 && !$value2),
            ValidationMessage::PAIR_RESTRICTION_FAIL,
            $this->getName(),
            $childName1,
            $childName2
        );
    }

    /**
     * Validate is obligatory child not empty
     *
     * @param string $value
     * @param string $childName
     */
    private function validateObligatoryField(?string $value, string $childName): void
    {
        $this->processValidationStep(
            !empty($value),
            ValidationMessage::OBLIGATORY_NOT_SET_OR_EMPTY,
            $this->getName(),
            $childName
        );
    }

    /**
     * Validate has entity only one child
     *
     * @param bool $condition
     */
    private function validateAllowedOneChildOnly(bool $condition): void
    {
        $this->processValidationStep(
            $condition,
            ValidationMessage::ALLOWED_ONE_CHILD_ONLY,
            $this->getName()
        );
    }

    /**
     * Getter of atrribute name in format will be injected into validation message
     * @param string $name
     * @throws DsigXmlBuilderException
     * @return string
     */
    private function getAttributeNameForMessage(string $name): string
    {
        if (!Attribute::isValid($name)) {
            throw new DsigXmlBuilderException("Invalid attribute name: `{$name}`");
        }

        return "{$name}(attribute)";
    }

    /**
     * Validate is attribute not empty
     *
     * @param string $value
     * @param string $attributeName
     */
    private function validateAttributeNotEmpty(?string $value, string $attributeName): void
    {
        $this->validateIsNotEmpty($value, $this->getAttributeNameForMessage($attributeName));
    }

    /**
     * Validate is attribute proper URI
     * @param string $value
     * @param string $attributeName
     */
    private function validateAttributeValidUri(?string $value, string $attributeName): void
    {
        $this->validateIsUri($value, $this->getAttributeNameForMessage($attributeName));
    }

    /**
     * Validate has atrribute legal value
     * @param string $algorithm
     * @param array $haystack
     * @param string $attributeName
     */
    private function validateAttributeLegal(?string $algorithm, array $haystack, string $attributeName): void
    {
        $this->validateIsLegalValue(
            $algorithm,
            $haystack,
            $this->getAttributeNameForMessage($attributeName),
            $algorithm
        );
    }

    /**
     * Getter of main element name
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    abstract protected function processValidation(DSigTypeInterface $entity): void;

    /**
     * Getter of validation result
     * @return ValidationResult
     */
    abstract public function getResult(): ValidationResult;

    /**
     * Getter of silent mode flag
     * @return bool
     */
    abstract public function isSilentMode(): bool;

    /**
     * Notifies observers about validation result
     *
     * @return ValidatorAbstract
     */
    abstract public function notifyObservers(): ValidatorAbstract;
}
