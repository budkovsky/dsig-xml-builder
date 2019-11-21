<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Tests\Partial;

trait XmlSecTrait
{
    protected $xmlsecInstalled = false;

    private function setXmlSecStatus(): void
    {
        if (\preg_match('/xmlsec1 \d\.\d\.\d{1,2}/', \shell_exec("xmlsec1 --version 2>&1")))
        {
            $this->xmlsecInstalled = true;
        }
    }

    private function checkXmlSecInstalled(): void
    {
        if (!$this->xmlsecInstalled) {
            $this->markTestSkipped('XmlSec not installed,test skipped');
        }
    }

    abstract public static function markTestSkipped(string $message = ''): void;
}

