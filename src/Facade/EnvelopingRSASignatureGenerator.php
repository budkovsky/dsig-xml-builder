<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Helper\Calculation;

class EnvelopingRSASignatureGenerator extends RSAGeneratorAbstract
{
    /** @var \Budkovsky\DsigXmlBuilder\Entity\ReferenceType */
    protected $contentReferenceEntity;

    public static function create(): EnvelopingRSASignatureGenerator
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
