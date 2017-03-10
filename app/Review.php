<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function places() {
      return $this->belongsTo('App\Place');
    }
}
