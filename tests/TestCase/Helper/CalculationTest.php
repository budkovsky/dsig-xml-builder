<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Helper;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Exception\PemException;
use Budkovsky\DsigXmlBuilder\Helper\Calculation;

class CalculationTest extends TestCase
{
    public function testThrowsExceptionOnTrimmingInvalidKeyBody(): void
    {
        $this->expectException(PemException::class);
        Calculation::trimPemBody('&%$@! asdofioeeer %^&');
    }
}
