<?php
namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\Aid\Helper\EntityTest;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit;

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

    public function testCanSetAdapter(): void
    {
        $entity = $this->getEntity();
        $entity->setAdapter($this->getAdapterMock());
        $this->assertInstanceOf(AdapterAbstract::class, $entity->getAdapter());
    }

    protected function getEntity(): DSigTypeInterface
    {
        return new $this->class;
    }

    /**
     * @return MockObject|AdapterAbstract
     */
    protected function getAdapterMock(): MockObject
    {
        return $this->createMock(AdapterAbstract::class);
    }

    abstract public static function assertTrue($condition, string $message = ''): void;

    abstract public function testAreGettersNullable(): void;

    abstract public function testDoesGettersAndSettersWork(): void;

    /**
     * @see PHPUnit\Framework\TestCase::createMock()
     */
    abstract protected function createMock($originalClassName): MockObject;
}
