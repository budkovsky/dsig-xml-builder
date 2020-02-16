<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use ReflectionClass;
use PHPUnit;

trait EnumTestTrait
{
    /**
     * @var ReflectionClass
     */
    protected $reflectionClass;

    public function testGetallReturnsValidLengthArray(): void
    {
        $this->assertEquals(
            count($this->getConstList()),
            count($this->getGetAllResult())
        );


    }

    public function testGetallReturnsProperValues(): void
    {
        $constList = $this->getConstList();
        $getAllResult = $this->getGetAllResult();

        foreach ($constList as $const) {
            $this->assertTrue(\in_array($const, $getAllResult));
        }
    }

    protected function getConstList(): array
    {
        return $this->reflectionClass->getConstants();
    }

    protected function getGetAllResult(): array
    {
        return $this->reflectionClass->getMethod('getAll')->invoke(null);
    }

    /**
     * @see PHPUnit\Framework\TestCase::setUp()
     */
    abstract protected function setUp(): void;

    /**
     * @see PHPUnit\Framework\Assert::assertTrue()
     */
    abstract public static function assertTrue($condition, string $message = ''): void;

    /**
     * @see PHPUnit\Framework\Assert::assertEquals()
     */
    abstract public static function assertEquals(
        $expected,
        $actual,
        string $message = '',
        float $delta = 0.0,
        int $maxDepth = 10,
        bool $canonicalize = false,
        bool $ignoreCase = false
    ): void;
}
