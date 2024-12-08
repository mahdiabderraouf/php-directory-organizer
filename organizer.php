<?php

require_once __DIR__ . '/vendor/autoload.php';

use MahdiAbderraouf\PhpDirectoryOrganizer\ArgumentsParser;
use MahdiAbderraouf\PhpDirectoryOrganizer\Organizer;

try {
    $arguments = ArgumentsParser::parse();

    echo "PHP directory organizer v1.0.0 by Abderraouf MAHDI.\n";

    $organizer = new Organizer($arguments);
    $organizer->organize();

    echo 'Directory ' . $arguments['directory'] . " organized successfully.\n";
} catch (InvalidArgumentException $e) {
    echo 'An error occured: ' . $e->getMessage() . "\n";
    exit;
}
