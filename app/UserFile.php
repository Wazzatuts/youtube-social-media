<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'file_path' => $this->file_name
        ];
    }
}
