<?php


namespace App\Repositories;

use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use App\StatusUpdate;

class StatusUpdateRepository implements StatusUpdateRepositoryContract
{
    public function newStatus(array $newData)
    {
        try {
            $newStatus = new StatusUpdate();
            $newStatus->fill($newData);
            $newStatus->save();

            return $newStatus;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
