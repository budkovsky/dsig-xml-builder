<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\ProcessorInterface;
use Budkovsky\Aid\Abstraction\StaticFactoryInterface;

/**
 * Interface for XML digital signature generator(facade)
 */
interface GeneratorInterface extends StaticFactoryInterface, DOMDocumentGetter, ProcessorInterface
{
    /**
     * Setter for content to be signed
     * @param string $content
     */
    public function setContent(string $content);

    /**
     * Setter for canonicalization method algorithm
     * @param string $algorithm
     */
    public function setCanonicalizationAlgorithm(string $algorithm);

    /**
     * Setter for digest value algorithm
     * @param string $algorithm
     */
    public function setDigestAlgorithm(string $algorithm);

    /**
     * Setter for signing algorithm
     * @param string $algorithm
     */
    public function setSignatureAlgorithm(string $algorithm);
}
