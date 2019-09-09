<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\Aid\Helper\RandomString;

trait SimplyContentEntityTestTrait
{
    use EntityTestTrait;

    public function testAreGettersNullable(): void
    {
        $this->assertNull($this->class::create()->getSimpleContent());
    }

    public function testDoesGettersAndSettersWork(): void
    {
        $entity = $this->class::create()->setSimpleContent($simpleContent = RandomString::get(100));

        $this->assertEquals($simpleContent, $entity->getSimpleContent());
    }

    abstract public static function assertNull($actual, string $message = ''): void;

    abstract public static function assertEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void;

}
