<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

trait CreationTestTrait
{
    protected $class;

    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            $this->class,
            new $this->class
        );
    }

    public function testCanBeCreatedByStaticFactory(): void
    {
        $this->assertInstanceOf(
            $this->class,
            $this->class::create()
        );
    }

    abstract function setUp(): void;

    abstract public static function assertInstanceOf(string $expected, $actual, string $message = ''): void;
}
