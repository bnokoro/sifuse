<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileUploader
{
    public static function uploadFile($file, $file_path)
    {
        if ($image = $file) {
            $path = Storage::put('public/' . $file_path, $image);
            return env('APP_URL') . Storage::url($path);
        }
        return '';
    }
}
