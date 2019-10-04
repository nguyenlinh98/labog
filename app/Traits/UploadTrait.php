<?php


namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function UploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        // kiem tra xem $name file co  ton tai khong
        //if a filename has been passed
        //if not then we are creating a random string name.
        $name = !is_null($filename) ? $filename : str_random(25);

        // lay duoi mo rong trong file upload
        $extension = $uploadedFile->getClientOriginalExtension();

        $file = $uploadedFile->storeAs($folder, $name . '.' . $extension, $disk);

        return $file;


    }



}