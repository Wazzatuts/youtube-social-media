<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    public function user()
    {
        return $this->belongsTo("User");
    }
}
