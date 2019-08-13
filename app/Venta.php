<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function announce()
    {
        return $this->belongsTo('App\Announce');
    }
}
