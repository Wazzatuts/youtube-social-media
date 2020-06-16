<?php


namespace App\Repositories\Contracts;


interface StatusUpdateRepositoryContract
{
    public function newStatus(array $newData);
}
