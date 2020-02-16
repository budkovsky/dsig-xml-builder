<?php
/**
 * Example how to run unit test from PHP code in CLI-like way
 */
declare(strict_types = 1);

use PHPUnit\TextUI\Command;

include(__DIR__.'/../vendor/autoload.php');

$command = new Command();
$command->run(['phpunit', 'TestCase']);