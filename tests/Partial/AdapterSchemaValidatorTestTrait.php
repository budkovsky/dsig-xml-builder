<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Enum\XmlNs;

trait AdapterSchemaValidatorTestTrait
{
    use CreationTestTrait;

    protected $schemaPath = __DIR__.'/../../docs/schema/xmldsig-core-schema.xsd';

    protected function isGeneratedXmlValid(DSigTypeInterface $entity): bool
    {
        /** @var \DOMDocument $document */
        $document = new \DOMDocument();
        /** @var \Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface $adapter */
        $adapter = $entity->getAdapter()
            ->setNamespace(XmlNs::XML_DSIG_2000_09)
            ->setElementPrefix('ds:')
        ;
        /** @var ExtendedDomElement $element */
        $element = $adapter
            ->setDocument($document)
            ->setEntity($entity)
            ->generate()
            ->getDOMElement()
        ;
        $document->appendChild($element);

        return $document->schemaValidate($this->schemaPath) === true ?? false;
    }

    abstract public function testIsGeneratedXmlValidWithSchema(): void;
}

