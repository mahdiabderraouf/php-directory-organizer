<?php

namespace MahdiAbderraouf\PhpDirectoryOrganizer;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class Organizer
{
    private string $directory;

    private const string DOCUMENTS_DIRECTORY = 'Documents';
    private const string IMAGES_DIRECTORY = 'Images';
    private const string VIDEOS_DIRECTORY = 'Videos';
    private const string SPREADSHEETS_DIRECTORY = 'Spreadsheets';
    private const string PRESENTATIONS_DIRECTORY = 'Presentations';
    private const string AUDIO_DIRECTORY = 'Audio';
    private const string OTHERS_DIRECTORY = 'Others';

    private const array DIRECTORY_BY_EXTENSION = [
        // Documents
        'doc' => self::DOCUMENTS_DIRECTORY,
        'docx' => self::DOCUMENTS_DIRECTORY,
        'pdf' => self::DOCUMENTS_DIRECTORY,
        'txt' => self::DOCUMENTS_DIRECTORY,
        'odt' => self::DOCUMENTS_DIRECTORY,
        'rtf' => self::DOCUMENTS_DIRECTORY,

        // Images
        'jpg' => self::IMAGES_DIRECTORY,
        'jpeg' => self::IMAGES_DIRECTORY,
        'png' => self::IMAGES_DIRECTORY,
        'gif' => self::IMAGES_DIRECTORY,
        'bmp' => self::IMAGES_DIRECTORY,
        'svg' => self::IMAGES_DIRECTORY,
        'tiff' => self::IMAGES_DIRECTORY,
        'ico' => self::IMAGES_DIRECTORY,

        // Videos
        'mp4' => self::VIDEOS_DIRECTORY,
        'avi' => self::VIDEOS_DIRECTORY,
        'mov' => self::VIDEOS_DIRECTORY,
        'mkv' => self::VIDEOS_DIRECTORY,
        'flv' => self::VIDEOS_DIRECTORY,
        'wmv' => self::VIDEOS_DIRECTORY,
        'webm' => self::VIDEOS_DIRECTORY,

        // Spreadsheets
        'xls' => self::SPREADSHEETS_DIRECTORY,
        'xlsx' => self::SPREADSHEETS_DIRECTORY,
        'csv' => self::SPREADSHEETS_DIRECTORY,
        'ods' => self::SPREADSHEETS_DIRECTORY,

        // Presentations
        'ppt' => self::PRESENTATIONS_DIRECTORY,
        'pptx' => self::PRESENTATIONS_DIRECTORY,
        'odp' => self::PRESENTATIONS_DIRECTORY,

        // Audio
        'mp3' => self::AUDIO_DIRECTORY,
        'wav' => self::AUDIO_DIRECTORY,
        'aac' => self::AUDIO_DIRECTORY,
        'flac' => self::AUDIO_DIRECTORY,
        'ogg' => self::AUDIO_DIRECTORY,
        'm4a' => self::AUDIO_DIRECTORY,
        'wma' => self::AUDIO_DIRECTORY,
    ];

    public function __construct(
        public array $arguments
    ) {
        $this->directory = $arguments['directory'];
    }

    public function organize(): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->directory, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        $tmpDir = uniqid();

        foreach ($iterator as $fileInfo) {
            /** @var SplFileInfo $fileInfo */
            if (!$fileInfo->isFile()) {
                continue;
            }


            $moveToDirectory = $tmpDir .
                '/' .
                (self::DIRECTORY_BY_EXTENSION[$fileInfo->getExtension()] ?? self::OTHERS_DIRECTORY);

            if (!file_exists($moveToDirectory)) {
                mkdir($moveToDirectory, recursive: true);
            }

            $moveTo = $moveToDirectory . '/' . $fileInfo->getFilename();

            copy($fileInfo->getPathname(), $moveTo);
        }

        exec('rm -rf ' . $this->directory);
        rename($tmpDir, $this->directory);
    }
}
