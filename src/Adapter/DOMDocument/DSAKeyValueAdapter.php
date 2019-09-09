<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

class DSAKeyValueAdapter extends AdapterAbstract
{
    protected function getEntity(): DSAKeyValueType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = DSAKeyValueType::class;
    }

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::DSA_KEY_VALUE_ELEMENT);
        $this
            ->generateDSAKeyValueChild(Tag::P_ELEMENT, $this->getEntity()->getP())
            ->generateDSAKeyValueChild(Tag::Q_ELEMENT, $this->getEntity()->getQ())
            ->generateDSAKeyValueChild(Tag::G_ELEMENT, $this->getEntity()->getG())
            ->generateDSAKeyValueChild(Tag::Y_ELEMENT, $this->getEntity()->getY())
            ->generateDSAKeyValueChild(Tag::J_ELEMENT, $this->getEntity()->getJ())
            ->generateDSAKeyValueChild(Tag::SEED_ELEMENT, $this->getEntity()->getSeed())
            ->generateDSAKeyValueChild(Tag::PGEN_COUNTER_ELEMENT, $this->getEntity()->getPgenCounter())
        ;

        return $this;
    }

    private function generateDSAKeyValueChild(string $name, ?string $value): DSAKeyValueAdapter
    {
        if ($value) {
            $this->generateChild($name, $value);
        }

        return $this;
    }
}
