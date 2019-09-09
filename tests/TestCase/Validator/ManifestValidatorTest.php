<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Validator\Entity\ManifestValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Entity\ManifestType;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\Aid\Helper\RandomString;

class ManifestValidatorTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(ManifestValidator::class, new ManifestValidator());
    }

    public function testCanBeCreatedByStaticFactory(): void
    {
        $this->assertInstanceOf(ManifestValidator::class, ManifestValidator::create());
    }

    public function testCanSetName(): void
    {
        $this->assertNotEmpty(ManifestValidator::create()->getName());
    }

    public function testAtLeastOneReferenceRequired(): void
    {
        $this->assertTrue(
            ManifestValidator::create()
                ->validate(ExampleEntity::getManifest())
                ->isValid()
        );

        $this->expectException(RestrictionException::class);
        ManifestValidator::create()->validate(ManifestType::create());
    }

    public function testCanValidateIdAttribute(): void
    {
        $entity = ExampleEntity::getManifest()->setIdAttribute(RandomString::get());
        $this->assertTrue(ManifestValidator::create()->validate($entity)->isValid());

        $this->expectException(RestrictionException::class);
        ManifestValidator::create()->validate($entity->setIdAttribute(''));
    }
}

