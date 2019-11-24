<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Helper\Calculation;

class RSAEnvelopingSignatureGenerator extends RSAGeneratorAbstract
{
    public static function create(): RSAEnvelopingSignatureGenerator
    {
        return new static;
    }

    protected function processObject(): GeneratorAbstract
    {
        $this->signatureEntity->addObject(
            ObjectType::create()
                ->setIdAttribute($this->getContentId())
                ->setSimpleContent(Calculation::preCanonicalize($this->content))
        );

        return $this;
    }

    protected function getDigestValueBase(): string
    {
        return $this->document->getElementById($this->getContentId())->C14N();
    }
}
