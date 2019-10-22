<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Helper;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;

class ExampleAnyType implements DSigTypeInterface, StaticFactoryInterface
{
    use EntityAdapterTrait;

    /** @var string */
    private $subelement1;

    /** @var string */
    private $subelement2;

    public static function create(): ExampleAnyType
    {
        return new static;
    }

    public function getSubelement1(): ?string
    {
        return $this->subelement1;
    }

    public function getSubelement2(): ?string
    {
        return $this->subelement2;
    }

    public function setSubelement1(string $subelement1): ExampleAnyType
    {
        $this->subelement1 = $subelement1;

        return $this;
    }

    public function setSubelement2(string $subelement2): ExampleAnyType
    {
        $this->subelement2 = $subelement2;

        return $this;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new ExampleAnyAdapter();
    }

}

