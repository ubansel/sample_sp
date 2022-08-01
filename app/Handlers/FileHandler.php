<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Facade;

class FileHandler extends Facade
{

    public static function validateFile($file, int $fileSize, string|null $fileExtension = null) : bool
    {
        // Do file validation here

    }

    public static function storeFile($file, string $filelocation, string $fileName) : string
    {
        return $file->storeAs(
            $filelocation,
            $fileName,
        );
    }

}
