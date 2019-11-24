<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

class RSADetachedSignatureGenerator extends RSAGeneratorAbstract
{
    public static function create(): RSADetachedSignatureGenerator
    {
        return new static;
    }

    protected function processSignedInfo(): GeneratorAbstract
    {
         parent::processSignedInfo();
         $this->contentReferenceEntity
            ->setUriAttribute($this->content)
            ->addTransform(
                TransformType::create()->setAlgorithmAttribute(
                    'http://www.w3.org/TR/2001/REC-xml-c14n-20010315'
                )
            )
         ;

        return $this;
    }

    protected function getDigestValueBase(): string
    {
         $document = new \DOMDocument();
         $document->loadXML(file_get_contents($this->content));

        return $document->C14N();
    }

    protected function processObject(): GeneratorAbstract
    {
        return $this; //<Object> element does not exist in detached signature
    }
}
