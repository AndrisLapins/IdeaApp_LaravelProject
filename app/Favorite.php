<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function post() {
        return $this->hasOne('App\Post');
    }

    public function user() {
        return $this->belongsTo('App\User'); // hasOne method maybe
    }
}
