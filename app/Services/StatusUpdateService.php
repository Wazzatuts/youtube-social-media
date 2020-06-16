<?php


namespace App\Services;


use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use Illuminate\Support\Facades\Auth;

class StatusUpdateService
{
    protected $statusUpdateRepositoryContract;

    public function __construct(StatusUpdateRepositoryContract $statusUpdateRepositoryContract)
    {
        $this->statusUpdateRepositoryContract = $statusUpdateRepositoryContract;
    }

    public function newStatus(array $data)
    {
        $userId = Auth::user()->id;

        $newData = [
            'user_id' => $userId,
            'status' => $data['status'],
        ];

        return $this->statusUpdateRepositoryContract->newStatus($newData);

    }
}
