<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','price','content','memory','stock','path'
    ];

    public $timestamps = false;

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'product_order')->withPivot('quantity');
    }
}
