<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Tests\Helper\ExampleEntity;
use Budkovsky\DsigXmlBuilder\Validator\Entity\KeyValueValidator;
use PHPUnit\Framework\TestCase;

class KeyValueValidatorTest extends TestCase
{
    public function testThrowsExceptionIfEmptyEntity(): void
    {
        $this->expectException(RestrictionException::class);
        KeyValueValidator::create()->validate(new KeyValueType());
    }

    public function testCanValidateAnyChild(): void
    {
        $entity = new KeyValueType();
        $entity->setAny(new CanonicalizationMethodType());
        $this->assertTrue(KeyValueValidator::create()->validate($entity)->isValid());

        $this->expectException(RestrictionException::class);
        $entity->setDsaKeyValue(new DSAKeyValueType());
        KeyValueValidator::create()->validate($entity);
    }

    public function testCanValidateRsaKeyValue(): void
    {
        $entity = new KeyValueType();
        $entity->setRsaKeyValue(ExampleEntity::getRSAKeyValue());
        $this->assertTrue(KeyValueValidator::create()->validate($entity)->isValid());

        $this->expectException(RestrictionException::class);
        $entity->setDsaKeyValue(ExampleEntity::getDsaKeyValue());
        KeyValueValidator::create()->validate($entity);
    }

    public function testCanValidateDsaKeyValue(): void
    {
        $entity = new KeyValueType();
        $entity->setDsaKeyValue(ExampleEntity::getDSAKeyValue());
        $this->assertTrue(KeyValueValidator::create()->validate($entity)->isValid());

        $this->expectException(RestrictionException::class);
        $entity->setRsaKeyValue(ExampleEntity::getRSAKeyValue());
        KeyValueValidator::create()->validate($entity);
    }
}

