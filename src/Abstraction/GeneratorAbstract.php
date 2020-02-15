<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\AbstractFactoryInterface;
use Budkovsky\DsigXmlBuilder\Partial\GeneratorPropertyTrait;

/**
 * Abstraction for XML digital signature generator(facade)
 */
abstract class GeneratorAbstract implements GeneratorInterface, AbstractFactoryInterface
{
    use GeneratorPropertyTrait;

    /**
     * XML digital dignature processing
     * {@inheritDoc}
     */
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

    /**
     * KeyInfo element processing
     * @return GeneratorAbstract
     */
    abstract protected function processKeyInfo(): GeneratorAbstract;

    /**
     * Object element processing
     * @return GeneratorAbstract
     */
    abstract protected function processObject(): GeneratorAbstract;

    /**
     * SIgnedInfo element processing
     * @return GeneratorAbstract
     */
    abstract protected function processSignedInfo(): GeneratorAbstract;

    /**
     * SignatureValue element processing
     * @return GeneratorAbstract
     */
    abstract protected function processSignatureValue(): GeneratorAbstract;

    /**
     * Digest and signature calculation
     * @return GeneratorAbstract
     */
    abstract protected function processCalculation(): GeneratorAbstract;
}
