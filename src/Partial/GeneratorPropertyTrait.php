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

/**
 * Trait for generator with basic set of properties
 */
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

    /**
     * Generator's constructor
     */
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

    /**
     * Setter for the content to be signed
     *
     * @param string $content
     * @return self
     */

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Setter for `format output?` flag
     *
     * @param bool $formatOutput
     * @return self
     */

    public function setFormatOutput(bool $formatOutput): self
    {
        $this->formatOutput = $formatOutput;

        return $this;
    }

    /**
     * Setter for canonicalization algorithm
     *
     * @see CanonicalizationAlgorithm
     *
     * @param string $algorithm
     * @throws CanonicalizationAlgorithmException
     * @return self
     */

    public function setCanonicalizationAlgorithm(string $algorithm): self
    {
        if (!CanonicalizationAlgorithm::isValid($algorithm)) {
            throw new CanonicalizationAlgorithmException("Invalid canonicalization algorithm: `{$algorithm}`");
        }
        $this->canonicalizationAlgorithm = $algorithm;

        return $this;
    }

    /**
     * Setter for digest algorithm
     *
     * @see DigestAlgorithm
     *
     * @param string $algorithm
     * @throws DigestAlgorithmException
     * @return self
     */

    public function setDigestAlgorithm(string $algorithm): self
    {
        if (!DigestAlgorithm::isValid($algorithm)) {
            throw new DigestAlgorithmException("Invalid digest algorithm: `{$algorithm}");
        }
        $this->digestAlgorithm = $algorithm;

        return $this;
    }

    /**
     * Setter for signature algorithm
     *
     * @see SignatureAlgorithm
     *
     * @param string $algorithm
     * @throws SignatureAlgorithmException
     * @return self
     */

    public function setSignatureAlgorithm(string $algorithm): self
    {
        if (!SignatureAlgorithm::isValid($algorithm)) {
            throw new SignatureAlgorithmException("Invalid signature algorithm: `{$algorithm}`");
        }
        $this->signatureAlgorithm = $algorithm;

        return $this;
    }

    /**
     * Setter for signature id attribute
     *
     * @param string $id
     * @return self
     */

    public function setSignatureId(string $id): self
    {
        $this->signatureId = $id;

        return $this;
    }

    /**
     * Getter of signature id attribute
     * @return string
     */

    protected function getSignatureId(): string
    {
        return $this->signatureId ?? $this->signatureId = RandomString::get();
    }

    /**
     * Setter for content id attribute
     * @param string $id
     * @return self
     */

    public function setContentId(string $id): self
    {
        $this->contentId = $id;

        return $this;
    }

    /**
     * Getter of content id attribute
     * @return string
     */

    protected function getContentId(): string
    {
        return $this->contentId ?? $this->contentId = RandomString::get();
    }

    /**
     * Setter for signature value id attribute
     *
     * @param string $id
     * @return self
     */

    public function setDigestValueId(string $id): self
    {
        $this->digestValueId = $id;

        return $this;
    }

    /**
     * Getter of content reference id
     *
     * @return string
     */

    protected function getcontentReferenceId(): string
    {
        return $this->contentReferenceId ?? $this->contentReferenceId = RandomString::get();
    }

    /**
     * Setter for signature value id attribute
     * @param string $id
     * @return self
     */

    public function setSignatureValueId(string $id): self
    {
        $this->signatureValueId = $id;

        return $this;
    }

    /**
     * Getter of signature value id attribute
     * @return string
     */

    protected function getSignatureValueId(): string
    {
        return $this->signatureValueId ?? $this->signatureValueId = RandomString::get();
    }

    /**
     * Setter for KeyInfo mode
     *
     * @see KeyInfoMode
     *
     * @param int $mode
     * @return self
     */

    public function setKeyInfoMode(int $mode): self
    {
        $this->keyInfoMode = $mode;

        return $this;
    }

    /**
     * Getter of signature document as DOMDocument
     *
     * @return \DOMDocument
     */

    public function getDOMDocument(): \DOMDocument
    {
        return $this->document;
    }

    /**
     *
     * Getter of signature document as a string
     *
     * @return string
     */

    public function get(): string
    {
        return $this->document->saveXML();
    }
}
