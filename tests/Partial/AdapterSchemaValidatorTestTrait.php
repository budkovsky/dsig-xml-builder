<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\ExtendedDomElement\ExtendedDomElement;

trait AdapterSchemaValidatorTestTrait
{
    use CreationTestTrait;

    protected $schemaPath = __DIR__.'/../../docs/schema/xmldsig-core-schema.xsd';

    protected function isGeneratedXmlValid(DSigTypeInterface $entity): bool
    {
        /** @var \DOMDocument $document */
        $document = ExtendedDomElement::getDomDocument();
        /** @var \Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface $adapter */
        $adapter = new $this->class;
        /** @var ExtendedDomElement $element */
        $element = $adapter
            ->setDocument($document)
            ->setEntity($entity)
            ->generate()
            ->getDOMElement()
        ;
        $document->appendChild($element);

        echo $document->saveXML();

        return $document->schemaValidate($this->schemaPath) === true ?? false;
    }

    abstract public function testIsGeneratedXmlValidWithSchema(): void;
}

