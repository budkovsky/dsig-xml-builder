<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Validator\Entity\RetrievalMethodValidator;
use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;

class RetrievalMethodValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = RetrievalMethodValidator::class;
    }

    public function testIsUriRequired(): void
    {
        $entity = RetrievalMethodType::create()->setUriAttribute('http://aaa.com#bbb');
        $this->assertTrue(RetrievalMethodValidator::create()->validate($entity)->isValid());

        $this->expectException(RestrictionException::class);
        RetrievalMethodValidator::create()->validate(new RetrievalMethodType());
    }

    public function testIsTypeValidUriIfExists(): void
    {
        //Type attribute not set
        $entity = RetrievalMethodType::create()->setUriAttribute('http://aaa.com#bbb');
        $this->assertTrue(RetrievalMethodValidator::create()->validate($entity)->isValid());

        //Type attribute set with proper value
        $entity->setTypeAttribute('http://aaa.info#ccc');
        $this->assertTrue(RetrievalMethodValidator::create()->validate($entity)->isValid());

        //Type attribute set with wrong value
        $this->expectExceptionMessageMatches('/Type/');
        $entity->setTypeAttribute('#%^ERF sfdgko 123');
        RetrievalMethodValidator::create()->validate($entity);
    }
}
