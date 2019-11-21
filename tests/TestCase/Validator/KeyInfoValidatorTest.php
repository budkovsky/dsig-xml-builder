<?php
namespace Budkovsky\DsigXmlBuilder\Tests\TestCase\Validator;

use PHPUnit\Framework\TestCase;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Validator\Entity\KeyInfoValidator;
use Budkovsky\Aid\Helper\RandomString;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Tests\Partial\CreationTestTrait;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\KeyName;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\MgmtData;

class KeyInfoValidatorTest extends TestCase
{
    use CreationTestTrait;

    public function setUp(): void
    {
        $this->class = KeyInfoValidator::class;
    }

    public function testCanValidateEmptyEntity(): void
    {
        $entity = new KeyInfoType();
        $entity->addChild(KeyName::create()->setSimpleContent(RandomString::get()));
        $this->assertTrue(
            KeyInfoValidator::create()->validate($entity)->isValid()
        );

        $this->expectException(RestrictionException::class);
        KeyInfoValidator::create()->validate(new KeyInfoType());
    }

    public function testCanValidateEmptyKeyName(): void
    {
        $this->expectExceptionMessageRegExp(
            sprintf('/%s/', Tag::KEY_NAME_ELEMENT)
        );
        KeyInfoValidator::create()->validate(
            KeyInfoType::create()
                ->addChild(
                    KeyName::create()->setSimpleContent('')
                )
        );
    }

    public function testCanValidateEmptyMgmtData(): void
    {
        $this->expectExceptionMessageRegExp(
            sprintf('/%s/', Tag::MGMT_DATA_ELEMENT)
        );
        KeyInfoValidator::create()->validate(
            KeyInfoType::create()
            ->addChild(
                MgmtData::create()->setSimpleContent('')
            )
        );
    }
}
