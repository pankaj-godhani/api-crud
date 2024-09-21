<?php


namespace App\Enums;


abstract class FileTypes
{
    const IMAGE = 'image';
    const VIDEO = 'video';
    const PDF = 'pdf';

    const All_FILE_TYPES = [
        'IMAGE' => self::IMAGE,
        'VIDEO' => self::VIDEO,
        'PDF' => self::PDF,
    ];
}
