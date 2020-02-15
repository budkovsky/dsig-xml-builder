<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509CRL;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509Certificate;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SKI;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SubjectName;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

/**
 * Validator for X509DataType entity
 */
class X509DataValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    /**
     * Runs validation
     *
     * @param DSigTypeInterface $entity
     */
    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\X509DataType $entity */
        if ($entity->getChildren()) {
            foreach ($entity->getChildren() as $child) {
                /** @var X509DataChildInterface */
                $this->validateX509DataChild($child);
            }
        }
    }

    /**
     * Validates child entity
     * @param EntityInterface $child
     */
    protected function validateX509DataChild(EntityInterface $child): void
    {
        switch (true) {
            case $child instanceof X509IssuerSerialType:
                X509IssuerSerialValidator::create()->addObserver($this)->validate($child);
                break;

            case $child instanceof X509SKI:
                $this->validateIsBase64($child, Tag::X509_SKI_ELEMENT);
                break;

            case $child instanceof X509SubjectName:
                $this->validateIsNotEmpty($child, Tag::X509_SUBJECT_NAME_ELEMENT);
                break;

            case $child instanceof X509Certificate:
                $this->validateIsBase64($child, Tag::X509_CERTIFICATE_ELEMENT);
                break;

            case $child instanceof X509CRL:
                $this->validateIsBase64($child, Tag::X509_CRL_ELEMENT);
                break;
        }
    }
}
