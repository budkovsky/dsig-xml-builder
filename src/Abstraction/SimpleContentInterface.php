<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\Aid\Abstraction\StringableInterface;
use Budkovsky\Aid\Abstraction\StaticFactoryInterface;

interface SimpleContentInterface extends EntityInterface, StringableInterface, StaticFactoryInterface
{
    public function setSimpleContent(string $simpleContent);

    public function getSimpleContent(): ?string;
}

