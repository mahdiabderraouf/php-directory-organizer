<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MahdiAbderraouf\PhpDirectoryOrganizer\ArgumentsParser;

try {
    echo json_encode(ArgumentsParser::parse()) . "\n";
} catch (InvalidArgumentException $e) {
    echo 'An error occured: ' . $e->getMessage() . "\n";
    exit;
}
