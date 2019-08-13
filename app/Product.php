<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ["nombre", "descripcion", "cantidad", "valor"];

    public function announces()
    {
        return $this->belongsToMany('App\Announce');
    }
}
