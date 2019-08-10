<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    protected $fillable = [
        'description',
        'product_id', 
        'status',
        'sold_date',
    ];

    protected $primaryKey = 'id';

    public function products()
    {
        return $this->belongsToMany('App\Products');
    }
}
