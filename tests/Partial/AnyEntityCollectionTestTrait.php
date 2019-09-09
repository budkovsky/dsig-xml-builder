<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\Aid\Collection\ValidatorCollection;
use Budkovsky\DsigXmlBuilder\Collection\EntityCollection;

trait EntityCollectionTestTrait
{
    abstract public function testAnyEntities(): void;

    private function executeEntitiesTest(EntityCollection $entityCollection, ValidatorCollection $validatorCollection): void
    {
        foreach ($entityCollection as $name => $entity) {
            /** @var \Budkovsky\Aid\Abstraction\EntityInterface $entity */
            /** @var \Budkovsky\Aid\Validator\Abstraction\ValidatorAbstract $validator */
            $validator = $validatorCollection->get($name);
            if ($validator) {
                $validator->addObserver($this)->validate($entity);
            }
        }
    }
}

