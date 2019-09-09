<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Validator\Entity;

use Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ValidatorEntityTrait;

class DSAKeyValueValidator extends ValidatorAbstract
{
    use ValidatorEntityTrait;

    protected function processValidation(DSigTypeInterface $entity): void
    {
        /** @var \Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType $entity */
        $p = $entity->getP();
        $q = $entity->getQ();
        $g = $entity->getG();
        $y = $entity->getY();
        $j = $entity->getJ();
        $seed = $entity->getSeed();
        $pgenCounter = $entity->getPgenCounter();

        $this->validatePair($p, $q, 'P', 'Q');
        if (!empty($g)) {
            $this->validateIsBase64($g, 'G');
        }
        $this->validateObligatoryField($y, 'Y');
        $this->validateIsBase64($y, 'Y');
        if (!empty($j)) {
            $this->validateIsBase64($j, 'J');
        }
        $this->validatePair($seed, $pgenCounter, 'Seed', 'PgenCounter');
    }

    protected function validatePair(?string $value1, ?string $value2, string $name1, $name2): void
    {
        $this->validatePairRestriction($value1, $value2, $name1, $name2);
        if ($value1) {
            $this->validateIsBase64($value1, $name1);
        }
        if ($value2) {
            $this->validateIsBase64($value2, $name2);
        }
    }
}
