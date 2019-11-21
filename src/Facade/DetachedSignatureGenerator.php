<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;

class DetachedSignatureGenerator extends RSAGeneratorAbstract
{
    public function process()
    {}

    public static function create()
    {}
    protected function processKeyInfo(): GeneratorAbstract
    {}

    protected function processCalculation(): GeneratorAbstract
    {}

    protected function processSignedInfo(): GeneratorAbstract
    {}

    protected function processSignatureValue(): GeneratorAbstract
    {}

    protected function processObject(): GeneratorAbstract
    {}

    protected function getDigestValueBase(): string
    {}

}

