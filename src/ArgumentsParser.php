<?php

namespace MahdiAbderraouf\PhpDirectoryOrganizer;

use InvalidArgumentException;

class ArgumentsParser
{
    public static function parse(): array
    {
        $args = getopt('', [
            'directory:',
        ]);

        if (!isset($args['directory'])) {
            throw new InvalidArgumentException('missing argument --directory');
        }

        if (!is_dir($args['directory'])) {
            throw new InvalidArgumentException('directory ' . $args['directory'] . ' not found');
        }

        return $args;
    }
}
