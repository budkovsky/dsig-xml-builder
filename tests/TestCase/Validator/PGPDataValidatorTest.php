<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Validator\Entity\PGPDataValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\Aid\Helper\RandomString;

class PGPDataValidatorTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            PGPDataType::class,
            new PGPDataType()
        );
    }

    public function testCanBeCreatedByStaticFactory(): void
    {
        $this->assertInstanceOf(
            PGPDataType::class,
            PGPDataType::create()
        );
    }

    public function testThrowsExceptionIncomplete(): void
    {
        $this->expectException(RestrictionException::class);
        PGPDataValidator::create()->validate(new PGPDataType());
    }

    public function testValidatesRequiredFields1(): void
    {
        $this->assertTrue(
            PGPDataValidator::create()
                ->validate(
                    PGPDataType::create()
                        ->setPgpKeyId(\base64_encode(RandomString::get())))
                ->isValid()

        );
    }

    public function testValidatesRequiredFields2(): void
    {
        $this->assertTrue(
            PGPDataValidator::create()
            ->validate(
                PGPDataType::create()
                ->setPgpKeyPacket(\base64_encode(RandomString::get())))
            ->isValid()

            );
    }

    public function testValidatesRequiredFields3(): void
    {
        $this->assertTrue(
            PGPDataValidator::create()
                ->validate(
                    PGPDataType::create()
                    ->setPgpKeyId(\base64_encode(RandomString::get()))
                    ->setPgpKeyPacket(\base64_encode(RandomString::get())))
                ->isValid()
        );
    }
}
