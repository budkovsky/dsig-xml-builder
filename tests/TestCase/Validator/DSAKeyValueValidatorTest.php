<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\DSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Validator\Entity\DSAKeyValueValidator;
use Budkovsky\Aid\Helper\RandomString;

class DSAKeyValueValidatorTest extends TestCase
{
    public function testYElementIsObligatory(): void
    {
        $entity = new DSAKeyValueType();
        $this->expectException(RestrictionException::class);
        DSAKeyValueValidator::create()->validate($entity);
    }

    public function testYElementIsBase64(): void
    {
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        try {
            DSAKeyValueValidator::create()->validate($entity);
        } catch(\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $entity->setY(' !@#$ %%^ &## ');
        $this->expectException(RestrictionException::class);
        DSAKeyValueValidator::create()->validate($entity);
    }

    public function testPQElementsMustExistOrNotExistTogether(): void
    {
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setP(\base64_encode(RandomString::get()));
        $entity->setQ(\base64_encode(RandomString::get()));
        try {
            DSAKeyValueValidator::create()->validate($entity);
        } catch(\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->expectException(RestrictionException::class);

        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setP(\base64_encode(RandomString::get()));
        DSAKeyValueValidator::create()->validate($entity);

        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setQ(\base64_encode(RandomString::get()));
        DSAKeyValueValidator::create()->validate($entity);
    }

    public function testGElementNotExistsOrIsBase64(): void
    {
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setG(\base64_encode(RandomString::get()));
        try {
            DSAKeyValueValidator::create()->validate($entity);
        } catch(\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->expectException(RestrictionException::class);
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setG('!#$#$ #$%#^% !#');
        DSAKeyValueValidator::create()->validate($entity);
    }

    public function testJElementNotExistsOrIsBase64(): void
    {
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setJ(\base64_encode(RandomString::get()));
        try {
            DSAKeyValueValidator::create()->validate($entity);
        } catch(\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->expectException(RestrictionException::class);
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setJ('@@@ ### %%%%');
        DSAKeyValueValidator::create()->validate($entity);
    }

    public function testSeedAndPgencounterElementsMustExistOrNotExistTogether(): void
    {
        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setSeed(\base64_encode(RandomString::get()));
        $entity->setPgenCounter(\base64_encode(RandomString::get()));
        try {
            DSAKeyValueValidator::create()->validate($entity);
        } catch(\Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->expectException(RestrictionException::class);

        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setSeed(\base64_encode(RandomString::get()));
        DSAKeyValueValidator::create()->validate($entity);

        $entity = new DSAKeyValueType();
        $entity->setY(\base64_encode(RandomString::get()));
        $entity->setPgenCounter(\base64_encode(RandomString::get()));
        DSAKeyValueValidator::create()->validate($entity);
    }
}
