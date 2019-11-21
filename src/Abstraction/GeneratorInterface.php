<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\ProcessorInterface;
use Budkovsky\Aid\Abstraction\StaticFactoryInterface;

interface GeneratorInterface extends StaticFactoryInterface, DOMDocumentGetter, ProcessorInterface
{
    public function setContent(string $content);

    public function setCanonicalizationAlgorithm(string $algorithm);

    public function setDigestAlgorithm(string $algorithm);

    public function setSignatureAlgorithm(string $algorithm);
}
