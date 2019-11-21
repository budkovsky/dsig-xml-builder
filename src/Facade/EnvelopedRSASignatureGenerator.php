<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

class EnvelopedRSASignatureGenerator extends RSAGeneratorAbstract
{
    /** @var \DOMElement */
    protected $signatureElement;

    /** @var string */
    protected $digestValueBase;

    public static function create(): EnvelopedRSASignatureGenerator
    {
        return new static;
    }

    protected function processSignedInfo(): GeneratorAbstract
    {
        $this->signatureEntity->getAdapter()->setNamespace('http://www.w3.org/2000/09/xmldsig#');
        $this->signatureEntity->setSignedInfo(
            SignedInfoType::create()
            ->setCanonicalizationMethod(CanonicalizationMethodType::create()->setAlgorithmAttribute($this->canonicalizationAlgorithm))
            ->setSignatureMethod(SignatureMethodType::create()->setAlgorithmAttribute($this->signatureAlgorithm))
            ->addReference(
                $this->contentReferenceEntity = ReferenceType::create()
                ->setDigestMethod(
                    DigestMethodType::create()
                    ->setAlgorithmAttribute($this->digestAlgorithm)
                    )
                ->setDigestValue('<!-- DIGEST VALUE -->')
                //->setIdAttribute($this->getcontentReferenceId())
                ->setUriAttribute('')
                ->addTransform(
                        TransformType::create()
                            ->setAlgorithmAttribute('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
                    )
                )
            );

        return $this;
    }

    public function loadDocument(string $xml): EnvelopedRSASignatureGenerator
    {
        $this->document->loadXML($xml);
        $this->digestValueBase = $this->document->documentElement->C14N();

        return $this;
    }

    public function setInsertBeforeElement(\DOMNode $node): EnvelopedRSASignatureGenerator
    {
        $this->insertBeforeElement = $node;

        return $this;
    }

    protected function getDigestValueBase(): string
    {
        return $this->digestValueBase;
    }

    protected function processObject(): GeneratorAbstract
    {

        return $this; //<Object> element does not exist in eveloped signature
    }
}
