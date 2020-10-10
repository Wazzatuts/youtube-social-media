<?php


namespace App\Repositories\Contracts;


interface ImageUploadRepositoryContract
{
    /**
     * @param $file
     * @return mixed
     */
    public function saveUpload($file);

}
