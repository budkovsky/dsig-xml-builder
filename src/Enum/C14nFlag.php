<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Enum;

/**
 * @see https://www.php.net/manual/en/domnode.c14n.php
 */
class C14nFlag
{
    const NORMAL = 0;
    const EXCLUSIVE = 1;
    const WITH_COMMENTS = 2;
}
