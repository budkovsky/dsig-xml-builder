<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509Certificate;
use Budkovsky\DsigXmlBuilder\Enum\KeyInfoMode;
use Budkovsky\DsigXmlBuilder\Enum\SignatureAlgorithm;
use Budkovsky\DsigXmlBuilder\Enum\SignatureMode;
use Budkovsky\DsigXmlBuilder\Exception\GeneratorException;
use Budkovsky\DsigXmlBuilder\Exception\SignatureModeException;
use Budkovsky\DsigXmlBuilder\Facade\RSADetachedSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Facade\RSAEnvelopingSignatureGenerator;
use Budkovsky\DsigXmlBuilder\Helper\Calculation;
use Budkovsky\OpenSslWrapper\Keystore;
use Budkovsky\OpenSslWrapper\PrivateKey;
use Budkovsky\OpenSslWrapper\Enum\KeyType;

/**
 * Abstraction for RSA generators
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
abstract class RSAGeneratorAbstract extends GeneratorAbstract
{
    /** @var string */
    protected $signatureAlgorithm = SignatureAlgorithm::RSA_SHA256;

    /** @var Keystore */
    protected $keystore;

    /**
     * XML node where <Signature> element is placed before.
     *
     * If null, signature is simple attached to the DOMDocument like with appendChild() method.
     * Not set for `enveloping` and `detached` signature, works with `enveloped` signature only.
     * @see https://www.php.net/manual/en/domnode.insertbefore.php
     * @see https://www.php.net/manual/en/domnode.appendchild.php
     *
     * @var \DOMNode
     */
    protected $insertBeforeElement;

    /**
     * Rerefence object for content
     * @var \Budkovsky\DsigXmlBuilder\Entity\ReferenceType
     */
    protected $contentReferenceEntity;

    /**
     * RSA keystore setter
     * @param Keystore $keystore
     * @return self
     */
    public function setKeystore(Keystore $keystore): self
    {
        $this->keystore = $keystore;

        return $this;
    }

    /**
     * RSA keystore getter
     * @return Keystore
     */
    public function getKeystore(): Keystore
    {
        return $this->keystore ?? $this->keystore = new Keystore();
    }

    /**
     * Abstract factory for types extending RSAGeneratorAbstract
     * @param string $mode
     * @throws SignatureModeException
     * @throws GeneratorException
     * @return GeneratorAbstract
     */
    public static function factory(?string $mode = null): GeneratorAbstract
    {
        if (!SignatureMode::isValid($mode)) {
            throw new SignatureModeException("Invalid signature mode: `{$mode}`");
        }

        switch ($mode) {
            case SignatureMode::ENVELOPED:
                $generator = new RSAEnvelopingSignatureGenerator();
                break;

            case SignatureMode::ENVELOPING:
                $generator = new RSAEnvelopingSignatureGenerator();
                break;

            case SignatureMode::DETACHED:
                $generator = new RSADetachedSignatureGenerator();
                break;

            default: //should not happen...
                throw new GeneratorException(
                    "Unexpected error while creating generator via abstract factory"
                );
                break;
        }

        return $generator;
    }

    /**
     * {@inheritDoc}
     */
    protected function processSignedInfo(): GeneratorAbstract
    {
        $this->signatureEntity->getAdapter()->setNamespace('http://www.w3.org/2000/09/xmldsig#');
        $this->signatureEntity->setSignedInfo(
            SignedInfoType::create()
                ->setCanonicalizationMethod(
                    CanonicalizationMethodType::create()->setAlgorithmAttribute($this->canonicalizationAlgorithm)
                )
                ->setSignatureMethod(
                    SignatureMethodType::create()->setAlgorithmAttribute($this->signatureAlgorithm)
                )
                ->addReference(
                    $this->contentReferenceEntity = ReferenceType::create()
                        ->setDigestMethod(
                            DigestMethodType::create()->setAlgorithmAttribute($this->digestAlgorithm)
                        )
                        ->setDigestValue('<!-- DIGEST VALUE -->')
                        ->setUriAttribute("#{$this->getContentId()}")
                )
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function processSignatureValue(): GeneratorAbstract
    {
        $this->signatureEntity->setSignatureValue(
            SignatureValueType::create()
            //->setIdAttribute($this->getSignatureValueId())
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function processKeyInfo(): GeneratorAbstract
    {
        $this->signatureEntity->setKeyInfo(KeyInfoType::create());

        if (($this->keyInfoMode & KeyInfoMode::RSA_KEY_VALUE)
            && $this->getKeystore()->getPrivateKey()
        ) {
            $this->processPrivateKey($this->getKeystore()->getPrivateKey());
        }

        $x509Data = new X509DataType();

        if (($this->keyInfoMode & KeyInfoMode::RSA_X509DATA_CERTIFICATE)
            && $this->getKeystore()->getCertificate()
        ) {
            $x509Data->addChild(
                X509Certificate::create()->setSimpleContent(
                    Calculation::trimPemBody($this->getKeystore()->getCertificate()->export())
                )
            );
        }

        if (($this->keyInfoMode & KeyInfoMode::RSA_X509DATA_EXTRA_CERTS)
            && $this->getKeystore()->getExtraCerts()
            && $this->getKeystore()->getExtraCerts()->count() > 0
        ) {
            foreach ($this->getKeystore()->getExtraCerts() as $extraCert) {
                /** @var \Budkovsky\OpenSslWrapper\X509 $extraCert */
                $x509Data->addChild(
                    X509Certificate::create()->setSimpleContent(
                        Calculation::trimPemBody($extraCert->export())
                    )
                );
            }
        }

        if ($x509Data->getChildren() && $x509Data->getChildren()->count() > 0) {
            $this->signatureEntity->getKeyInfo()->addChild($x509Data);
        }


        return $this;
    }

    /**
     * Private key processing
     * @param PrivateKey $key
     * @throws GeneratorException
     * @return RSAGeneratorAbstract
     */
    protected function processPrivateKey(PrivateKey $key): RSAGeneratorAbstract
    {
        /** @var \Budkovsky\OpenSslWrapper\Entity\PKeyDetailsRSA $keyDetails */
        $keyDetails = $key->getDetails();

        if ($keyDetails->getType() != KeyType::RSA) {
            throw new GeneratorException(
                "Invalid private key type. Different key than RSA not implemented."
            );
        }

        $this->signatureEntity->getKeyInfo()->addChild(
            KeyValueType::create()
            ->setRsaKeyValue(
                RSAKeyValueType::create()
                    ->setExponent(\base64_encode($keyDetails->getPublicExponent()))
                    ->setModulus(\base64_encode($keyDetails->getModulus()))
            )
        );

        return $this;
    }

    /**
     * Keystore processing
     * @return RSAGeneratorAbstract
     */
    protected function processKeystore(): RSAGeneratorAbstract
    {
        if (!$this->keystore) {
            return $this;
        }

        $x509Data = new X509DataType();
        if ($this->keystore->getCertificate()) {
            $x509Data->addChild(X509Certificate::create()->setSimpleContent(
                Calculation::trimPemBody($this->keystore->getCertificate()->export())
            ));
        }
        if ($this->keystore->getExtraCerts()) {
            foreach ($this->keystore->getExtraCerts() as $extraCert) {
                /** @var \Budkovsky\OpenSslWrapper\X509 $extraCert */
                $x509Data->addChild(X509Certificate::create()->setSimpleContent(
                    Calculation::trimPemBody($extraCert->export())
                ));
            }
        }

        return $this;
    }

    /**
     * Creates signature's root element
     * @return RSAGeneratorAbstract
     */
    protected function createSignatureElement(): RSAGeneratorAbstract
    {
        $signatureElement = $this->signatureEntity
            ->getAdapter()
            ->setDocument($this->document)
            ->setEntity($this->signatureEntity)
            ->generate()
            ->getDOMElement()
        ;

        if ($this->insertBeforeElement) {
            $this->insertBeforeElement->parentNode->insertBefore($signatureElement, $this->insertBeforeElement);
        } else {
            ($this->document->documentElement ?? $this->document)->appendChild($signatureElement);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function processCalculation(): GeneratorAbstract
    {
        $this->createSignatureElement();


        //calculating digest value and filling <DigestValue> element
        $digestValue = Calculation::getDigestValue(
            $this->contentReferenceEntity->getDigestMethod()->getAlgorithmAttribute(),
            $this->getDigestValueBase(),
            true
        );
        $this->document->getElementsByTagName('DigestValue')[0]->nodeValue = \base64_encode($digestValue);

        //calculating signature value and filling <SignatureValue> element
        $signatureValue = $this->getKeystore()->getPrivateKey()->sign(
            $this->document->getElementsByTagName('SignedInfo')[0]->C14N(),
            SignatureAlgorithm::map(
                $this->signatureEntity->getSignedInfo()->getSignatureMethod()->getAlgorithmAttribute()
            )
        );
        $this->document->getElementsByTagName('SignatureValue')[0]->nodeValue = \base64_encode($signatureValue);

        return $this;
    }

    /**
     * Getter for string is based for digest value
     * @return string
     */
    abstract protected function getDigestValueBase(): string;
}
