<?php


namespace App\Services;


use App\Helpers\StringHelpers;
use Illuminate\Support\Facades\Storage;

class FileServices
{
    /**
     * @param $file
     * @param $path
     * @return array
     */
    public static function upload($file, $path)
    {
        $fileName = StringHelpers::randomKeyGenerate().$file->getClientOriginalName();

        Storage::disk("public")->put($path . $fileName, file_get_contents($file));

        return [
            "path" => $path,
            "filename" => $fileName,
        ];
    }
}
