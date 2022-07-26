<?php

use Aux\Generator\Code;

require_once __DIR__ . '/../vendor/autoload.php';

$output = new \Symfony\Component\Console\Output\ConsoleOutput();

// Generating a random string
$output->writeln('<info>Random String</info>');
$output->writeln(Code::generate(10));

// Generating a unique random string
$output->writeln('<info>Random Unique String</info>');
$output->writeln(Code::unique(function ($token) {
    return $token != 1;
})->format('n'));

// Generating a random dollar amount (with specified format)
$output->writeln('<info>Random Number String</info>');
$output->writeln(Code::format('$nnnn.nn'));

// Generating a random formatted String
$output->writeln('<info>Random Formatted String</info>');
$output->writeln(Code::format('rrrr-rrrr-rrrr-rrrr'));