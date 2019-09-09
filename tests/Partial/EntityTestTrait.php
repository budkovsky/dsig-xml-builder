<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\Aid\Helper\EntityTest;

trait EntityTestTrait
{
    use CreationTestTrait;

    public function testHasNoPublicProperties(): void
    {
        $this->assertTrue(
            EntityTest::hasNoPublicProperties(new \ReflectionClass($this->class))
        );
    }

    public function testHasValidGetters(): void
    {
        $this->assertTrue(
            EntityTest::hasValidGetters(
                new \ReflectionClass($this->class)
            )
        );
    }

    public function testHasValidSetters(): void
    {
        $this->assertTrue(
            EntityTest::hasValidSetters(
                new \ReflectionClass($this->class)
            )
        );
    }

    abstract public static function assertTrue($condition, string $message = ''): void;

    abstract public function testAreGettersNullable(): void;

    abstract public function testDoesGettersAndSettersWork(): void;
}
