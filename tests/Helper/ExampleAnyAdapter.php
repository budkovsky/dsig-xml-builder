<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

class ExampleAnyAdapter extends AdapterAbstract
{
    protected $namespace = 'http:www.other.com/ns';
    protected $elementPrefix = 'otherns:';

    protected function getEntity(): ExampleAnyType
    {
        return $this->entity;
    }

    public function generate(): AdapterInterface
    {
        $this->generateMainElement('AnyElement');
        $this->generateChild(
            'SubElement1',
            $this->getEntity()->getSubelement1()
        );
        $this->generateChild(
            'SubElement2',
            $this->getEntity()->getSubelement2()
        );

        return $this;
    }

    protected function setEntityType(): void
    {
        $this->entityType = ExampleAnyType::class;
    }

}
