<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\AbstractFactoryInterface;
use Budkovsky\DsigXmlBuilder\Partial\GeneratorPropertyTrait;

abstract class GeneratorAbstract implements GeneratorInterface, AbstractFactoryInterface
{
    use GeneratorPropertyTrait;

    public function process(): GeneratorAbstract
    {
        $this->processSignedInfo()
            ->processSignatureValue()
            ->processKeyInfo()
            ->processObject()
            ->processCalculation()
        ;

        return $this;
    }

    abstract protected function processKeyInfo(): GeneratorAbstract;

    abstract protected function processObject(): GeneratorAbstract;

    abstract protected function processSignedInfo(): GeneratorAbstract;

    abstract protected function processSignatureValue(): GeneratorAbstract;

    abstract protected function processCalculation(): GeneratorAbstract;
}
