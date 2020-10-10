<?php


namespace App\Repositories;


use App\Repositories\Contracts\ImageUploadRepositoryContract;
use App\UserFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadRepository implements ImageUploadRepositoryContract
{
    public function saveUpload($file)
    {
        try {
            $newEntry = new UserFile();
            $newEntry->file_name = url(Storage::url($file));
            $newEntry->user_id = auth()->user()->id;
            $newEntry->save();

            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
