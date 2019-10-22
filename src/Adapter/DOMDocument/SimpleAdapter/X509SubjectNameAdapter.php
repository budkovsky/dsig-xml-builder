<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

class X509SubjectNameAdapter extends SimpleAdapterAbstract
{

    protected function getTagName(): string
    {
        return Tag::X509_SUBJECT_NAME_ELEMENT;
    }
}
