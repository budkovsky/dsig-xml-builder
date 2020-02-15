<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Helper\Calculation;

/**
 * Generator for enveloping RSA signature
 */
class RSAEnvelopingSignatureGenerator extends RSAGeneratorAbstract
{
    /**
     * Static factory for enveloping RSA signature generator
     *
     * @return RSAEnvelopingSignatureGenerator
     */
    public static function create(): RSAEnvelopingSignatureGenerator
    {
        return new static;
    }

    /**
     * {@inheritDoc}
     */
    protected function processObject(): GeneratorAbstract
    {
        $this->signatureEntity->addObject(
            ObjectType::create()
                ->setIdAttribute($this->getContentId())
                ->setSimpleContent(Calculation::preCanonicalize($this->content))
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getDigestValueBase(): string
    {
        return $this->document->getElementById($this->getContentId())->C14N();
    }
}
