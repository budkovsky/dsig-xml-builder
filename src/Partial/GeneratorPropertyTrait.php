<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Partial;

use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Enum\CanonicalizationAlgorithm;
use Budkovsky\DsigXmlBuilder\Enum\DigestAlgorithm;
use Budkovsky\DsigXmlBuilder\Enum\SignatureAlgorithm;
use Budkovsky\DsigXmlBuilder\Exception\CanonicalizationAlgorithmException;
use Budkovsky\DsigXmlBuilder\Exception\DigestAlgorithmException;
use Budkovsky\DsigXmlBuilder\Exception\SignatureAlgorithmException;

trait GeneratorPropertyTrait
{
    /** @var SignatureType */
    protected $signatureEntity;

    /** @var string */
    protected $content;

    /** @var \DOMDocument */
    protected $document;

    /** @var bool */
    protected $formatOutput;

    /** @var string */
    protected $canonicalizationAlgorithm = CanonicalizationAlgorithm::XML_1_0;

    /** @var string */
    protected $digestAlgorithm = DigestAlgorithm::SHA256;

    /** @var string */
    protected $signatureAlgorithm;

    /** @var string */
    protected $signatureId;

    /** @var string */
    protected $contentId;

    /** @var string */
    protected $contentReferenceId;

    /** @var string */
    protected $signatureValueId;

    /**
     * @var int
     * @see \Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode
     */
    protected $keyInfoMode;

    public function __construct()
    {
//         libxml_disable_entity_loader(true);
        $this->signatureEntity = new SignatureType();
        $this->document = new \DOMDocument('1.0', 'utf-8');
//         $this->document->preserveWhiteSpace = false;
//         $this->document->formatOutput = true;
//         $this->document->substituteEntities = false;
         $this->document->resolveExternals = false;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setFormatOutput(bool $formatOutput): self
    {
        $this->formatOutput = $formatOutput;

        return $this;
    }

    public function setCanonicalizationAlgorithm(string $algorithm): self
    {
        if (!CanonicalizationAlgorithm::isValid($algorithm)) {
            throw new CanonicalizationAlgorithmException("Invalid canonicalization algorithm: `{$algorithm}`");
        }
        $this->canonicalizationAlgorithm = $algorithm;

        return $this;
    }

    public function setDigestAlgorithm(string $algorithm): self
    {
        if (!DigestAlgorithm::isValid($algorithm)) {
            throw new DigestAlgorithmException("Invalid digest algorithm: `{$algorithm}");
        }
        $this->digestAlgorithm = $algorithm;

        return $this;
    }

    public function setSignatureAlgorithm(string $algorithm): self
    {
        if(!SignatureAlgorithm::isValid($algorithm)) {
            throw new SignatureAlgorithmException("Invalid signature algorithm: `{$algorithm}`");
        }
        $this->signatureAlgorithm = $algorithm;

        return $this;
    }

    public function setSignatureId(string $id): self
    {
        $this->signatureId = $id;

        return $this;
    }

    protected function getSignatureId(): string
    {
        return $this->signatureId ?? $this->signatureId = RandomString::get();
    }

    public function setContentId(string $id): self
    {
        $this->contentId = $id;

        return $this;
    }

    protected function getContentId(): string
    {
        return $this->contentId ?? $this->contentId = RandomString::get();
    }

    public function setDigestValueId(string $id): self
    {
        $this->digestValueId = $id;

        return $this;
    }

    protected function getcontentReferenceId(): string
    {
        return $this->contentReferenceId ?? $this->contentReferenceId = RandomString::get();
    }

    public function setSignatureValueId(string $id): self
    {
        $this->signatureValueId = $id;

        return $this;
    }

    protected function getSignatureValueId(): string
    {
        return $this->signatureValueId ?? $this->signatureValueId = RandomString::get();
    }

    public function setKeyInfoMode(int $mode): self
    {
        $this->keyInfoMode = $mode;

        return $this;
    }

    public function getDOMDocument(): \DOMDocument
    {
        return $this->document;
    }

    public function get(): string
    {
        return $this->document->saveXML();
    }
}
