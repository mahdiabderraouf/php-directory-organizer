<?php

namespace MahdiAbderraouf\PhpDirectoryOrganizer;

use InvalidArgumentException;

class ArgumentsParser
{
    public static function parse(): array
    {
        $arguments = getopt('', [
            'directory:',
        ]);

        if (!isset($arguments['directory'])) {
            throw new InvalidArgumentException('missing argument --directory');
        }

        if (!is_dir($arguments['directory'])) {
            throw new InvalidArgumentException('directory ' . $arguments['directory'] . ' not found');
        }

        $arguments['directory'] = rtrim($arguments['directory'], '/');

        return $arguments;
    }
}
