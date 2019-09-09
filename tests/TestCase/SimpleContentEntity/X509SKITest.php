<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\SimpleContentEntity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\SimplyContentEntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SKI;

class X509SKITest extends TestCase
{
    use SimplyContentEntityTestTrait;

    public function setUp(): void
    {
        $this->class = X509SKI::class;
    }
}

