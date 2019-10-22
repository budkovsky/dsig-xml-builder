<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class PGPDataAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::PGP_DATA_ELEMENT);

        if ($this->getEntity()->getPgpKeyId() !== null) {
            $this->generateChild(
                Tag::PGP_KEY_ID_ELEMENT,
                $this->getEntity()->getPgpKeyId()
            );
        }
        if ($this->getEntity()->getPgpKeyPacket() !== null) {
            $this->generateChild(
                Tag::PGP_KEY_PACKET_ELEMENT,
                $this->getEntity()->getPgpKeyPacket()
            );
        }
        $this->generateChildren();

        return $this;
    }

    protected function getEntity(): PGPDataType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = PGPDataType::class;
    }
}
