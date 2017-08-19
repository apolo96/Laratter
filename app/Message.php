<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toSearchableArray()
    {
        $this->load('user');
        return $this->toArray();
    }
}
