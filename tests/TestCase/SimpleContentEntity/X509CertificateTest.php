<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\SimpleContentEntity;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Tests\Partial\SimplyContentEntityTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509Certificate;

class X509CertificateTest extends TestCase
{
    use SimplyContentEntityTestTrait;

    public function setUp(): void
    {
        $this->class = X509Certificate::class;
    }
}

